<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Cookie;
use Illuminate\Support\Facades\Event;
use Adldap\Laravel\Events\AuthenticationRejected;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

   
    use AuthenticatesUsers {
        AuthenticatesUsers::login as performLogin;
   //     AuthenticatesUsers::logout as doLogout;
    }


   //  use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth', ['except' => ['performLogin', 'index']]);
        $this->middleware('guest')->except('logout');
    }

    public function username() {
        return "uid";
    }

    public function login(Request $request)
    {
        if (Auth::attempt($request->only(['uid', 'password']))) {
     
            $user = Auth::user();
        
            return redirect()->to('home')
                ->withMessage('Logged in!');
        }

        $errors = array(
            "uid" => "Username and/or password is not correct"
        );

        return redirect()->to('login')->withErrors($errors);
    }

}
