<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\UpdatePassword;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{
    // User Status API
    public function checkStatus(Request $request){
        $request->validate([
            'id' => 'required|integer',
        ]);
        $user = User::select('id','status')->findOrFail($request->id);
        if($user->status == 'active'){
            return response()->json([
                'success' => true,
            ], 200);
        }else{
            return response()->json([
                'success' => false,
            ], 500);
        }


    }
    public function login(Request $request)
    {
        $login =  $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        if(Auth::attempt(['username' => $request->email,'password' => $request->password]) || Auth::attempt(['email' => $request->email,'password' => $request->password])){
             $user = Auth::user();
             if($user->status == 'inactive'){
                Auth::logout();
                return response()->json([
                    'success' => false,
                    'message' => "Your account has been locked please contact system administrator",
                ], 404);
            }
            $token = Auth::user()->createToken('authToken')->accessToken;
            return [
                'user' => UserResource::make($user),
                'token' => $token
            ];
       }else{
        return response()->json([
            'success' => false,
            'error' => true,
            'message' => "The user name or password is incorrect",
        ], 404);
    }

        if (!Auth::attempt($login)) {
            return response()->json([
                'success' => false,
                'error' => true,
                'message' => "The user name or password is incorrect",
            ], 404);
        }
        $user = Auth::user();
        $token = Auth::user()->createToken('authToken')->accessToken;
        return [
            'user' => UserResource::make($user),
            'token' => $token
        ];
    }

    public function listing()
    {
        $user = User::get();
        return response([
            'success' => true,
            'users' => $user,
        ]);
    }

    public function singleUser($id)
    {
        $user =  User::find($id);
        if (!$user) {
            return response([
                'success' => false,
                'error' => true,
                'message' => 'no record found',
            ]);
        }
        return response()->json([
            'status' => true,
            'user' => UserResource::make($user),
        ]);
    }

    public function logOut(Request $request)
    {
        return response([
            'message' => 'User Logout successfully',
        ]);
    }
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'name' => 'required|string',
            'registered_type' => 'required',
            'password' => 'required',
            'username' => 'required',
        ]);
        if($request->registered_type == 'facebook' || $request->registered_type == 'google'){
            $checkUser  = User::where('email', $request->email)->first();
            if ($checkUser) {
                if($checkUser->status == 'inactive'){
                    Auth::logout();
                    return response()->json([
                        'success' => false,
                        'message' => "Your account has been locked please contact system administrator",
                    ], 404);
                }else{
                    Auth::login($checkUser);
                    $token = Auth::user()->createToken('authToken')->accessToken;
                    return [
                        'user' => UserResource::make($checkUser),
                        'token' => $token
                    ];
                }


            }else{
                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->username = $request->username;
                $user->registered_type = $request->registered_type;
                $user->password = Hash::make($request->password);
                $user->google_id = $request->google_id;
                $user->facebook_id = $request->facebook_id;
                $user->notification_token = $request->notification_token;
                $user->phone = $request->phone;
                $user->save();
                $user->assignRole('customer');
                if($request->has('photo')){
                    $photo = 'photo-'.$user->id.'.'.$request->photo->extension();
                    $user->addMediaFromRequest('photo')->usingName($photo)->toMediaCollection('profile_photo');
                }
                Auth::login($user);
                $token = Auth::user()->createToken('authToken')->accessToken;
                return [
                    'user' => UserResource::make($user),
                    'token' => $token
                ];
            }
        }else{
            DB::beginTransaction();
            try{
                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->username = $request->username;
                $user->registered_type = $request->registered_type;
                $user->password = Hash::make($request->password);
                $user->google_id = $request->google_id;
                $user->facebook_id = $request->facebook_id;
                $user->notification_token = $request->notification_token;
                $user->phone = $request->phone;
                $user->save();
                $user->assignRole('customer');
                if($request->has('photo')){
                    $photo = 'photo-'.$user->id.'.'.$request->photo->extension();
                    $user->addMediaFromRequest('photo')->usingName($photo)->toMediaCollection('profile_photo');
                }
                Auth::login($user);
                $token = Auth::user()->createToken('authToken')->accessToken;
                DB::commit();
                return [
                    'user' => UserResource::make($user),
                    'token' => $token
                ];

            }catch(Exception $e){
                DB::rollBack();
                Log::info($e);
                return response()->json([
                    'success' => false,
                    'error' => true,
                    'message' => "Username or email already exists",
                ]);
            }
        }


    }


    public function addAccount(Request $request)
    {

            $request->validate([
                'registered_type' => 'required',
                'user_id' => 'required',
            ]);

            if($request->registered_type == 'facebook' || $request->registered_type == 'google'){

                    $user = User::findOrFail($request->user_id);
                    if($request->google_id == ''){
                        $user->google_id = $user->google_id;
                    }else{
                        $user->google_id = $request->google_id;
                    }
                    if($request->facebook_id == ''){
                        $user->facebook_id = $user->facebook_id;
                    }else{
                        $user->facebook_id = $request->facebook_id;
                    }

                 //   $user->registered_type = $request->registered_type;
                  //  $user->notification_token = $request->notification_token;
                    $user->save();
                    return [
                        'success'=> true,
                        'user' => UserResource::make($user),
                    ];
            }else{
                return [
                    'success'=> false,
                    'message' => 'Error while adding accounts',
                ];
            }

    }

    public function githubRedirect()
    {
        return Socialite::driver('github')->redirect();
    }
    public function githubCallback()
    {
        $gitHub = Socialite::driver('github')->user();
        $checkUserEmail  = User::where('email', $gitHub->email)->first();
        if ($checkUserEmail) {
            return response()->json([
                'success' => false,
                'error' => true,
                'message' => "email already exisits",
            ]);
        }
        //  $dob =  Carbon::parse($request->dob)->format('Y-m-d');
        $password = Str::random(20);
        $password = Hash::make($password);
        $user = new User;
        if ($gitHub->name == '') {
            $name = $gitHub->login;
        } else {
            $name = $gitHub->name;
        }
        $user->email = $gitHub->email;
        //$user->dob = $dob;
        // $user->gender = $request->gender;
        $user->name = $name;
        $user->registered_type = 'github';
        $user->password = $password;
        $user->status = 'inactive';
        $token = Crypt::encryptString($name . ',' . $gitHub->email);
        if ($user->save()) {
            $user->addMediaFromURL($gitHub->avatar)->toMediaCollection('profile_photo');
            Mail::to($gitHub->email)->send(new UpdatePassword($user, $token));
            return UserResource::make($user);
        } else {
            return response()->json([
                'success' => false,
                'error' => true,
                'message' => "there is an error while creating a user",
            ], 404);
        }
    }
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);
        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        Mail::send('emails.forgetPassword', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });
        return response()->json([
            'success' => true,
            'error' => false,
            'message' => "we have e-mailed your password reset link!",
        ], 404);
    }

    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }
    public function googleCallback()
    {
        $google = Socialite::driver('google')->user();
        $checkUserEmail  = User::where('email', $google->email)->first();
        if ($checkUserEmail) {
            return response()->json([
                'success' => false,
                'error' => true,
                'message' => "email already exisits",
            ]);
        }
        $password = Str::random(20);
        $password = Hash::make($password);
        $user = new User;
        $user->email = $google->email;
        $user->name = $google->name;
        $user->registered_type = 'google';
        $user->password = $password;
        $user->status = 'inactive';
        $token = Crypt::encryptString($google->name . ',' . $google->email);
        if ($user->save()) {
            $user->addMediaFromURL($google->avatar_original)->toMediaCollection('profile_photo');
            Mail::to($google->email)->send(new UpdatePassword($user, $token));
            return UserResource::make($user);
        } else {
            return response()->json([
                'success' => false,
                'error' => true,
                'message' => "there is an error while creating a user",
            ], 404);
        }
    }


    public function updateProfile(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
        ]);

        $user = User::findOrFail($request->user_id);
        if($request->name){
            $user->name = $request->name;
        }
        if($request->last_name){
            $user->last_name = $request->last_name;
        }
        if($request->phone){
            $user->phone = $request->phone;
        }
        if($request->address){
            $user->address = $request->address;
        }
        if($request->email){
            $user->email = $request->email;
        }
        if($request->gender){
            $user->gender = $request->gender;
        }
        if($request->password != '' or $request->password != null ){
            $user->password =  Hash::make($request->password);
        }
        if($user->save()){
            if($request->has('profile_photo')){
                $photo = 'user-'.$user->id.'-profile.'.$request->profile_photo->extension();
                $user->clearMediaCollection('profile_photo');
                $user->addMediaFromRequest('profile_photo')->usingName($photo)->toMediaCollection('profile_photo');
             }

            return response(['success' => true,
                             'url'=> $user->getFirstMediaUrl('profile_photo','thumb'),
                             'message' => 'user has been updated successfully']);
        }else{
            return response(['success' => false,'message' => 'user not updated']);
        }

    }

    public function tokenUpdate(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'notification_token' => 'required',
        ]);
        $user = User::where('id',$request->user_id)->first();
        if($user){
            $user->notification_token = $request->notification_token;
            $user->save();
            return response(['success' => true,'message' => 'Notification token updated']);
        }else{
            return response(['error' => true,'message' => 'User not exists']);
        }


    }
}
