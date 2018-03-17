<?php

namespace App\Helpers;

use Adldap\Laravel\Facades\Adldap;
use App\LdapGroup;
use App\LdapUser;
use ErrorException;
use Exception;

class LdapHelper {
    public static function GetLdapGroups() {
        $entries = Adldap::search()->where("objectClass" , "=", 'posixGroup')->get();

        $groups = array();

        foreach ($entries as $entry) {

            $id = $entry->getAttribute('gidnumber')[0];
            $name = $entry->getAttribute('cn')[0];

            //  Skip unit 'person' since this is an internal unit

            $groups[$id] = $name;
        }

        return $groups;
    }
   
    public static function GetLdapLookupGroups() {
        $entries = Adldap::search()->where("objectClass" , "=", 'posixGroup')->get();

        $groups = array();

        foreach ($entries as $entry) {

            $id = $entry->getAttribute('gidnumber')[0];
            $name = $entry->getAttribute('cn')[0];

            //  Skip unit 'person' since this is an internal unit

            $groups[] = array("group_id" => $id, "group_name" => $name);
        }

        return $groups;
    }

    public static function GetLdapOrganizationalUnits() {
        $entries = Adldap::search()->where('objectClass', '=', 'organizationalUnit')->get();

        $groups = array();

        foreach ($entries as $entry) {
           
            $name = $entry->getAttribute('ou')[0];

            //  Skip unit 'person' since this is an internal unit

            if ($name == "person") {
                continue;
            }
            $groups[] = $name;
        }

        return $groups;
    }

    public static function GetLdapOrganizationalRoles() {
        $entries = Adldap::search()->where('objectClass', '=', 'organizationalRole')->get();

        $groups = array();

        foreach ($entries as $entry) {
            if (in_array('simpleSecurityObject', $entry->getAttribute('objectclass'))) {
                continue;
            }
            $name = $entry->getAttribute('cn')[0];

            $groups[] = $name;
        }

        return $groups;
    }
    
    public static function DeleteUser($userName) {
        $user = Adldap::search()->where("uid", "=", $userName)->first();

        if (!$user) {
            return;
        }

        $user->delete();
    }

    public static function CreateUser($username, $firstName, $lastName, $userPassword, $gidNumber, $groupName) {
        $user = Adldap::make()->user([
            'uid' => $username, 
            'cn' => array($username, $groupName),
            'sn' => $lastName,
            'ou' => "groups",
            'givenName' => $firstName,
            'gidNumber' => $gidNumber,
            'homeDirectory' => '/home' . $username,
            'loginShell' => '/bin/bash',
            'uidNumber' => "2001",
            "departmentNumber" => $groupName,
            'dn' => 'cn=' . $username . ',cn=' . $groupName . ',ou=groups,dc=rroyce,dc=com',
            'userPassword' => $userPassword
        ]);

        $user->setAttribute('objectclass', array('inetOrgPerson', 'posixAccount', 'person') );

        try {
            $user->save();

            $entries = Adldap::search()->where('objectClass', '=', 'organizationalUnit')->get();   
        }
        catch(ErrorException $ex) {
            if (stripos($ex->getMessage(), "Add: Already exists") !== FALSE) {
                throw new ErrorException("User already exists");
            }

            throw new ErrorException("Error creating user: " . $ex->getMessage());
        }   
        finally {
           echo "Finally<br>";
        }     

      
    }

    public static function GetUsers() {
        $groups = LdapHelper::GetLdapGroups();

        \Log::info("Getting user entries");

        $columns = array('givenname', 'sn', 'uid', 'gidnumber', 'entryuuid');
  
        $query = Adldap::search()->getQuery();

        $query->columns = $columns;
       
        $entries = $query->where("objectClass", "=", "person")->get();

        $ldapUsers = array();

        foreach ($entries as $entry) {
            $ldapUser = new LdapUser();

            $ldapUser->givenName = $entry->GetAttribute("givenname")[0];
            $ldapUser->surName = $entry->GetAttribute("sn")[0];
            $ldapUser->userName = $entry->GetAttribute("uid")[0];
            $ldapUser->group = $groups[$entry->getAttribute('gidnumber')[0]];
            $ldapUser->entryUUID = $entry->GetAttribute("entryuuid")[0];

            $ldapUsers[] = $ldapUser;
        }

        return $ldapUsers;        
    }


    public static function GetUser($userName) {
        $groups = LdapHelper::GetLdapGroups();

        $entry = Adldap::search()->where("uid", "=", $userName)->first();

        $ldapUser = new LdapUser();

        $ldapUser->givenName = $entry->GetAttribute("givenname")[0];
        $ldapUser->surName = $entry->GetAttribute("sn")[0];
        $ldapUser->userName = $entry->GetAttribute("uid")[0];
        $ldapUser->groupId = $entry->getAttribute('gidnumber')[0];       
        $ldapUser->groupName = $groups[$entry->getAttribute('gidnumber')[0]];

        return $ldapUser;        
    }    
}   
