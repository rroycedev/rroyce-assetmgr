<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB; 

class DatabaseAuthHelper {
        public  static function GetRoles() {
                $results = DB::table('user_role')->get();

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
                $results = DB::table('users')->join('user_role', 'users.user_role_id', '=', 'user_role.user_role_id')->where('is_system_admin', 0)->get();
              
                $retResults = array();

                foreach ($results as $result) {
                        $mappedResult = DatabaseAuthHelper::mapDatabaseToVueResult($result);

                        $retResults[] = $mappedResult;        
                }
                
             //   dd($retResults);

                return $retResults;
        }       
        
        public static function CreateUser($username, $firstName, $lastName, $userPassword, $emailAddress, $roleId) {
                echo "Database inserting user row with username [$username]<br>";
        
                $row = [
                        'uid' => $username,
                        'user_role_id' => $roleId,
                        'first_name' => $firstName,
                        'last_name' => $lastName,
                        'email' => $emailAddress,
                        'password' => bcrypt($userPassword),
                        "is_system_admin" => 0,
                ];

                DB::table('users')->insert($row);
        }
}