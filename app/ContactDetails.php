<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactDetails extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'phone_number', 'user_id', 'fb_url', 'tw_url', 'skype_usr', 'my_rank', 'name',
    ];
}
