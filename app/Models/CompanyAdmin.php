<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class CompanyAdmin extends Authenticatable
{
    protected $table = 'company_admins';
    
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'token',
        'last_login'
    ];
}
