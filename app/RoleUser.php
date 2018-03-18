<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Role;

class RoleUser extends Model
{
    protected $table = 'role_user';

    public function users()
    {
      return $this->belongsToMany(User::class, $this->table);
    }

    public function roles() {
        return $this->belongsToMany(Role::class, $this->table);
    }
}
