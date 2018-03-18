<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB; 

use App\Role;
use App\User;
use App\RoleUser;

class DatabaseAuthHelper {
        public  static function GetRoles() {
                $results = DB::table('roles')->orderBy('name')->get();

                $retResults = array();

                foreach ($results as $result) {
                        $retResults[] = $result;        
                }
                
                return $retResults;
        }

        private static function mapDatabaseToVueResult($result) {
                $mapping = config('dbtovuemapping.tovue');

                $newResult = array();

                foreach ($mapping as $key => $value) {
                        $newResult[$value] = $result->$key;
                }

                return $newResult;
        }

        public  static function GetUsers() {
                $results = DB::table('users')
                        ->join('role_user', 'users.id', '=', 'role_user.user_id')
                        ->join('roles', 'role_user.role_id', '=', 'roles.id')
                        ->where('users.is_system_object', 0)->get();
              
                $retResults = array();

                foreach ($results as $result) {
                        $mappedResult = DatabaseAuthHelper::mapDatabaseToVueResult($result);

                        $retResults[] = $mappedResult;        
                }
                
             //   dd($retResults);

                return $retResults;
        }       
        
        public static function CreateUser($username, $firstName, $lastName, $userPassword, $emailAddress, $roleIds) {
                echo "Database inserting user row with username [$username]<br>";

                $user = User::where("uid", $username)->first();
        
                if ($user) {
                        throw new Exception("User already exists");
                }

                $user = new User();

                $user->uid = $username;
                $user->first_name = $firstName;
                $user->last_name = $lastName;
                $user->password = bcrypt($userPassword);
                $user->email = $emailAddress;

                $user->save();

                foreach ($roleIds as $roleId) {
                        $role =  Role::where("id", $roleId)->first();

                        $arguments = array("role_id" => $roleId, "user_id" => $user->id);

                        $role_mapping = RoleUser::where($arguments)->first();
        
                        if (!$role_mapping) {
                                $user->roles()->attach($role);
                        }    
                }
        }

}