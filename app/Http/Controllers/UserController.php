<?php

namespace App\Http\Controllers;

use App\Events\OrderStatusUpdate;
use App\Events\OrderUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
class UserController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function setNewPassword($token,$email){
        $token = $token;
        $email = $email;
        $decrypted_token = Crypt::decryptString($token);
        $explode = explode(',', $decrypted_token);
        $user= User::where('name',$explode[0])->where('email',$explode[1])->first();
        if($user){
            $UserToken = Crypt::encryptString($user->id);
            return view('newpassword',compact('user','UserToken'));
         }else{
            return view('auth.login')->with('Invalid token, make sure you pass a correct token key');
         }

    }
    public function UpdatePassword(Request $request){
        $request->validate([
            'email' => 'required|min:7|max:55|email',
            'password' => 'required|min:7|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:7',
            'encrypted'=>'required',
        ]);
        $user_id =   Crypt::decryptString($request->encrypted);
        $user = User::where('id',$user_id)->first();
        $user->password = Hash::make($request->password);
        $user->status = 'active';
        if($user->save()){
            return redirect()->route('login')->with('success','Password has been updated successfully');
        }else{
            return redirect()->back()->with('error','Error while updating password');
        }
    }
    public function githubRedirect(){
        return Socialite::driver('github')->redirect();
    }

    public function googleRedirect(){
        return Socialite::driver('google')->redirect();
    }
    public function googleCallback(){
        $user = Socialite::driver('google')->user();
        dd($user);
        // $checkUser = User::where('github_id', $githubUser->id)->first();
        //   $checkUser = User::where('email', $user->email)->first();
        // if ($user) {
        //     return response([
        //         'success' => true,
        //         'user' =>$user,
        //     ]);
        // } else {
        //     return response([
        //         'success' => false,
        //         'message' => 'User not exists',
        //     ]);
        // }
    }



}
