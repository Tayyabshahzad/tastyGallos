<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
       // dd($request->email);
        $user = User::where('email',$request->email)->first();

        if($user){

            if($user->status == 'inactive'){
                return redirect()->route('login')->with('error','Your account has been locked please contact system administrator');
            }

            $request->authenticate();
            if(auth()->user()->hasRole('admin')){
                return redirect()->intended(RouteServiceProvider::HOME);
            }else{
                return redirect()->intended(RouteServiceProvider::FRANCHISE);
            }
            $request->session()->regenerate();
        }else{
            return redirect()->route('login')->with('error','Inavlid! User not exists');
        }





        /// Check LogedIn User Role..

    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $user =User::findOrFail(Auth::user()->id);
        $user->order_notification = '';
        $user->save();
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
