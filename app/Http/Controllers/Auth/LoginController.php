<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Cookie;
use Illuminate\Support\Facades\Event;
use Adldap\Laravel\Events\AuthenticationRejected;
use Illuminate\Http\Request;

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

   /*
    use AuthenticatesUsers {
        AuthenticatesUsers::login as peformLogin;
        AuthenticatesUsers::logout as doLogout;
    }
*/

    use AuthenticatesUsers;

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

    /*
    public function performLogin(Request $request) {
        if (!$request) {
            return redirect('/exception');
        }

        \Log::info('LoginController: Logging in....');

        $result = $this->login($request);

        $user = \Auth::user();

     
        $username = $user->getUsername();
        $firstname = $user->getFirstName();
        $lastname = $user->getLastName();
     //   $groupname = $user->getGroupName();

        Cookie::queue("auth-loggedin", true, 60 * 24);
        Cookie::queue("auth-username", $username, 60 * 24);
        Cookie::queue("auth-firstname", $firstname, 60 * 24);
        Cookie::queue("auth-lastname", $lastname, 60 * 24);
       // Cookie::queue("auth-groupname", $groupname, 60 * 24);
       
        return $result;
    }

    public function logout(Request $request = null) {
        \Log::info('LoginController: Logging out....');

        Cookie::queue("auth-loggedin", false, 60 * 24);
        Cookie::queue("auth-username", "", 60 * 24);
        Cookie::queue("auth-firstname", "", 60 * 24);
        Cookie::queue("auth-lastname", "", 60 * 24);
        Cookie::queue("auth-groupname", "", 60 * 24);

        return $this->doLogout($request);
    }
    */
}
