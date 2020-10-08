<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = [
        'name',
        'state',
        'email',
        'address',
        'password',
        'token',
        'last_login'
    ];
}

