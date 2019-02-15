<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'TenantId', 'Username', 'password', 'LastPasswordUpdate', 'IsAdmin', 'LastUpdateBy', 'LastUpdateIPAddress', 'CreatedBy', 'CreatedIPAddress', 'LastLogin', 'LastLoginIPAddress', 'EmailAddress', 'Roles', 'AccountStatus', 'reference_url', 'refered_by', 'refered_status', 'varification_status', 'varification_code', 'name', 'parent_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function contact_details()
    {
        return $this->hasOne(ContactDetails::class, 'user_id', 'id');
    }

    public function text()
    {
        return $this->hasOne(ContactDetails::class, 'user_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(User::class, 'parent_id', 'id')->with('children')->with('text')->select('Username as name', 'id', 'parent_id');
    }
}
