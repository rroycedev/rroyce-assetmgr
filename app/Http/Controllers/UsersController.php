<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Notification;

use App\CreatedUser;
use App\Events\UserHasBeenCreated;
use App\User;
use Pusher\Pusher;
use App\Notifications\UserCreated;
use Adldap\Laravel\Facades\Resolver;
use App\Jobs\FulfillUser;
use Adldap\Laravel\Facades\Adldap;
use Illuminate\Support\Facades\Config;
use Adldap\Laravel\AdldapServiceProvider;

use App\Classes\LdapHelper;
use App\LdapUser;
use ErrorException;

class UsersController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    protected $adldap;

    protected $orgUnits = array();
    protected $orgRoles = array();


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function readUsers() {
        $data = LdapHelper::GetUsers();

        echo json_encode($data);
    }

    private function userProviderDriverName() {
        return env('ASSETMGR_USER_PROVIDER_DRIVER', 'eloquent');
    }

    public function index(/* AdldapServiceProvider $provider */) {
    //    $this->adldap = $provider;

        $driverName = env('ASSETMGR_USER_PROVIDER_DRIVER', 'eloquent');

        switch ($this->userProviderDriverName()) {
            case "eloquent":
                $data = array();
                break;
            case "ldap":
                $data = LdapHelper::GetUsers();
            break;
        }

        return view("user.list", ["users" => $data]);
    }

    private function userGroups() {
        switch ($this->userProviderDriverName()) {
            case "eloquent":
                $groups = array(
                        array("group_id" => 1, "group_name" => "Group 1"), 
                        array("group_id" => 2, "group_name" => "Group 2"),
                        array("group_id" => 3, "group_name" => "Group 3")
                );                                                
    
                return $groups;
            case "ldap":
                return LdapHelper::GetLdapLookupGroups();
            }
    
    }
    public function create(Request $request)
    {
        $data = ["data" => array("groups" => $this->userGroups(), "message" => "", "messagetype" => "")];

        return view('user.create', $data );
    } 

    public function edit($uid)
    {
        $groups = LdapHelper::GetLdapGroups();

        $data = LdapHelper::GetUser($uid);

        return view('user.edit', ["data" => array("groups" => $groups, "user" => $data, "orgUnits" => $this->orgUnits, "orgRoles" => $this->orgRoles)]);       
    } 
    public function store(Request $request)
    { 
        $formInput = $request->all();

        $username = $formInput["username"];
        $firstName = $formInput["first_name"];
        $lastName = $formInput["last_name"];
        $userPassword = $formInput["userpassword"];
        $groupId = $formInput["group_id"];

        $groups = LdapHelper::GetLdapGroups();

        $groupName = $groups[$groupId];

        try {
            LdapHelper::CreateUser($username, $firstName, $lastName, $userPassword, $groupId, $groupName);

            $request->session()->put('message', "User $username has been created successfully");
            $request->session()->put('messagetype', "success");
        }
        catch(ErrorException $ex) {
            $request->session()->put('message', $ex->getMessage());
            $request->session()->put('messagetype', "error");
        }        

        return redirect()->route('user.create');
    }   

    public function update(Request $request)
    { 
        $formInput = $request->all();

        dd($formInput);

          $username = $formInput["username"];
          $firstName = $formInput["first_name"];
          $lastName = $formInput["last_name"];
          $userPassword = $formInput["userpassword"];

          dd($this->orgUnits);
          
          $orgUnit = $this->orgUnits[$formInput["organizational_unit"]];
          $orgRole = $this->orgRoles[$formInput["organizational_role"]];
          
          dd($orgUnit);

            LdapHelper::CreateUser($username, $firstName, $lastName, $userPassword, $orgUnit, $orgRole);
    }   

    public function doCreate(Request $request) {
        dd($request);
    }

    public function destroy($uid)
    {
        LdapHelper::DeleteUser($uid);

        $users = User::findOrFail($uid);

        $users->delete();

        echo json_encode(array("success" => true, "msg" => ""));
    }    
}
