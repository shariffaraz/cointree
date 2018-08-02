<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactDetails extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'phone_number', 'user_id',
    ];
}
