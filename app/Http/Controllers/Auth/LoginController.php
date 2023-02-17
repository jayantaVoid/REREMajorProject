<?php

namespace App\Http\Controllers\Auth;

use App\Rules\ReCaptchaRule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

     public function login(Request $request){

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
            // 'recaptcha' => ['required', new ReCaptchaRule('login')]
        ]);
        // $password = Hash::make($request->password);
        $credentials = $request->only('email', 'password');
       // dd($credentials);
       // dd(Auth::attempt($credentials));
        if (Auth::attempt($credentials)) {

            // Authentication passed...
            return redirect('/home',);
        }

        else
        {
            // Session::flash('message', 'Login failed!');
            // Session::flash('alert-class', 'alert-danger');
            return redirect('/login')->with('message', 'Email or password not matched!');
        }


     }
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
