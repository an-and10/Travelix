<?php

namespace App\Models;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    use Notifiable,HasApiTokens;

    protected $guarded= [];

    protected $guard = 'admin';

    protected $hidden = [
        'password', 'remember_token',
    ];

}
