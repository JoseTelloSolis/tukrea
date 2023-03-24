<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Clientes extends Authenticatable
{
  use Notifiable;

  protected $guard = 'clientes';

  protected $fillable = [
    'email', 'password',
  ];

  protected $hidden = [
  	'password', 'remember_token',
  ];
}
