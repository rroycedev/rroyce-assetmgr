<?php

namespace App\LdapSchema;

use Adldap\Schemas\BaseSchema;

class OpenLDAP extends BaseSchema
{

    public function userModel()
    {
        return "App\Ldap\Models\LdapUser";
    }

    public function userPrincipalName()
    {
        return 'uid';
    }

    /**
     * {@inheritdoc}
     */
    public function distinguishedName()
    {
        return 'dn';
    }

    /**
     * {@inheritdoc}
     */
    public function distinguishedNameSubKey()
    {
        //
    }

    /**
     * {@inheritdoc}
     */
    public function filterEnabled()
    {
        return sprintf('(!(%s=*))', $this->lockoutTime());
    }

    /**
     * {@inheritdoc}
     */
    public function filterDisabled()
    {
        return sprintf('(%s=*)', $this->lockoutTime());
    }

    /**
     * {@inheritdoc}
     */
    public function lockoutTime()
    {
        return 'pwdAccountLockedTime';
    }

    /**
     * {@inheritdoc}
     */
    public function objectCategory()
    {
        return 'objectclass';
    }

    /**
     * {@inheritdoc}
     */
    public function objectClassGroup()
    {
        return 'groupofnames';
    }

    /**
     * {@inheritdoc}
     */
    public function objectClassOu()
    {
        return 'groupofuniquenames';
    }

    /**
     * {@inheritdoc}
     */
    public function objectClassPerson()
    {
        return 'inetorgperson';
    }

    /**
     * {@inheritdoc}
     */
    public function objectGuid()
    {
        return 'entryuuid';
    }

    /**
     * {@inheritdoc}
     */
    public function objectGuidRequiresConversion()
    {
        return false;
    }
}
