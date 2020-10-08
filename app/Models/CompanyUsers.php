<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyUsers extends Model
{
    protected $table = 'company_users';

    protected $fillable = [
        'name',
        'firstname',
        'lastname',
        'email',
        'profile_completed',
        'company_id',
        'added_by',
        'token'
    ];
}
