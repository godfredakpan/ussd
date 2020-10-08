<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coperate extends Model
{
    protected $table = 'coperates';

    protected $fillable = [
        'rdrpgene',
        'interpretation',
        'observation',
        'covid_status',
        'egene',
        'mgene',
        'nsgene',
        'icgene',
        'authorized_at',
        'authorized_by',
        'consumer_user_id',
        'order_id',
        'company_id',
        'orf1ab',
        'ngene',
        'sgene'
    ];
}
