<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyInvite extends Model
{
    protected $table = 'company_invites';

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'token',
        'company_id',
        'status',
        'invite_status'
    ];
}
