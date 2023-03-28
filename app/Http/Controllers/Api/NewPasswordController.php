<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\resetPasswordApi;
use App\Models\User;
use App\Notifications\resetPassword;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Illuminate\Validation\ValidationException;

class NewPasswordController extends Controller
{
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $user = User::where('email', $request->email)->first();
        // Check user role
        if (!$user->hasRole('customer')) {
            return response([
                'success' => true,
                'message' => "We are unable to reset your password"
            ]);
        }
        $token =  mt_rand(1000,9999);
        DB::table('password_resets')
        ->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token,'created_at' => Carbon::now()]
        );
        $user = User::where('email', $request->email)->first();
        $userDetail = [
            'body' => 'Below is the password reset token please copy the token',
            'userDetailText' => $token,
            'url' => url('/'),
            'message' => 'This token will only user one time',
        ];
        if($user){
            $user->notify(new resetPassword($userDetail));
            return response([
                'success' => true,
                'message' => 'we have emailed you password reset link'
            ]);
        }else{
            return response([
                'success' => false,
                'message' => 'error while creating user'
            ]);
        }

    }
    public function validateToken(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users',
        ]);

        $updatePassword = DB::table('password_resets')->where(['email' => $request->email,'token' => $request->token])->first();
        if(!$updatePassword){
            return response([
                'success' => false,
                'error' => true,
                'message' => 'invalid token'
            ]);
        }else{
            return response([
                'success' => true,
                'error' => false,
            ]);
        }

    }
    public function setNewPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
        $deleteToken = DB::table('password_resets')->where(['email' => $request->email])->delete();
        return response([
            'success' => true,
            'message' => 'password has been changed'
        ]);

    }
}
