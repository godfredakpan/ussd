<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyUser extends Model
{
    protected $table = 'company_users';

    protected $fillable = [
        'name',
        'gender',
        'dob',
        'age',
        'sample_type',
        'email',
        'phone',
        'company_id',
        'order_id',
        'added_by',
        'created_at',
        'updated_at',
        'address',
        'lga',
        'village',
        'specimen_type',
        'date_collected',
        'date_hospitalized',
        'symptom_onset_date',
        'facility_referred_from',
        'date_sample_received',
        'lab_assigned_id',
        'initial_or_followup',
        'firstname',
        'lastname',
        'state',
        'is_validated',
        'token',
        'profile_completed',
        'state_sample_collected'
    ];

}
