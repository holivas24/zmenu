<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuarios extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['nombre', 'password'];
    protected $hidden = ['password', 'remember_token'];
}
