<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NigerianState extends Model
{
    protected $table = "nigerian_states";
    protected $fillable = [
        'name',
        'lga',
        'active'
    ];

}
