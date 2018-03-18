<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Role;

class User extends Authenticatable
{
    use Notifiable;


//    protected $primaryKey = 'username';

    /* The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid', 'first_name', 'last_name', 'email', 'password', 'is_system_object'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAuthIdentifierName() {
        return "uid";
    }

    public function getUsername() {
        echo "User: Returning username ...<br>";
        
        return $this->attributes["uid"];
    }

    public function getEmail() {
        return $this->attributes["mail"];
    }

    public function getFirstName() {
        return $this->attributes["first_name"];
    }

    public function getLastName() {
        return $this->attributes["last_name"];
    }

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

//    departmentNumber
    
}
