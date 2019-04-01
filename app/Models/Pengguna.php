<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengguna extends Authenticatable
{
    # set table
    protected $table = 'pengguna';

    # set guard
    protected $guard = 'pengguna';

    # set fillable
    protected $fillable = [
        'email',
        'password'
    ];
}
