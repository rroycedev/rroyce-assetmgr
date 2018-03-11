<?php
namespace App\Ldap\Database;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Auth;

use Adldap\Laravel\Facades\Resolver;
use Adldap\Laravel\Auth\NoDatabaseUserProvider;

use App\Ldap\Events\DiscoveredWithCredentials;
use App\Ldap\Models\LdapUser;

use Adldap\Laravel\Facades\Adldap;
use App\User;


class RRNoDatabaseUserProvider extends NoDatabaseUserProvider {
        public function retrieveByCredentials(array $credentials)
        {
            if ($user = Resolver::byCredentials($credentials)) {

                Event::fire(new DiscoveredWithCredentials($user));
    
                return $user;
            }
        }

        public function retrieveById($identifier)
        {
            $userEntries = Adldap::search()->where('uid', '=', $identifier)->get();

            $user = $userEntries[0];

            // Convert $user of class LdapUser to class App\User

            $convertedUser = $this->convertLdapUserToAppUser($user);

            Auth::setUser($convertedUser);

            return $convertedUser;
        }

        private function convertLdapUserToAppUser($ldapUser) {
            $attributes = $ldapUser->getAttributes();

            $uid = $attributes['uid'][0];
            $firstName = $attributes['givenname'][0];
            $lastName = $attributes['sn'][0];

            $newAttributes = array("uid" => $uid, "first_name" => $firstName, "last_name" => $lastName);

            return new User($newAttributes);
        }

        
}