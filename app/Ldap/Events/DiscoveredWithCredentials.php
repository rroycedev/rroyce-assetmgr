<?php
namespace App\Ldap\Events;

use App\Ldap\Models\LdapUser;

class DiscoveredWithCredentials
{
    /**
     * The discovered LDAP user before authentication.
     *
     * @var User
     */
    public $user;

    /**
     * Constructor.
     *
     * @param User $user
     */
    public function __construct(LdapUser $user)
    {
        $this->user = $user;
    }
}
