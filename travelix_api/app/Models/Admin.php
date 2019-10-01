<?php

namespace App\Models;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;


use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use Notifiable,HasApiTokens;

    protected $guarded= [];

    protected $guard = 'admin_api';

    protected $hidden = [
        'password', 'remember_token',
    ];

}
