<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsumerUser extends Model
{
    protected $table = 'consumer_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'first_name', 'last_name', 'email', 'phone', 'gender', 'dob', 'status', 'address', 'delivery_address', 'state', 'password'
    ];
    
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function setNameAttribute($name) {
        $this->attributes['name'] = openssl_encrypt($name, "AES-128-ECB", env('ENCRYPTION_KEY'));
    }

    public function getNameAttribute($name) {
        return openssl_decrypt($name, "AES-128-ECB", env('ENCRYPTION_KEY'));
    }

    public function setEmailAttribute($email) {
        $this->attributes['email'] = openssl_encrypt($email, "AES-128-ECB", env('ENCRYPTION_KEY'));
    }

    public function getEmailAttribute($email) {
        return openssl_decrypt($email, "AES-128-ECB", env('ENCRYPTION_KEY'));
    }

    public function setGenderAttribute($gender) {
        $this->attributes['gender'] = openssl_encrypt($gender, "AES-128-ECB", env('ENCRYPTION_KEY'));
    }

    public function getGenderAttribute($gender) {
        return openssl_decrypt($gender, "AES-128-ECB", env('ENCRYPTION_KEY'));
    }

    public function setDateOfBirthAttribute($dob) {
        $this->attributes['dob'] = openssl_encrypt($dob, "AES-128-ECB", env('ENCRYPTION_KEY'));
    }

    public function getDateOfBirthAttribute($dob) {
        return openssl_decrypt($dob, "AES-128-ECB", env('ENCRYPTION_KEY'));
    }

    public function setPhoneAttribute($phone) {
        $this->attributes['phone'] = openssl_encrypt($phone, "AES-128-ECB", env('ENCRYPTION_KEY'));
    }

    public function getPhoneAttribute($phone) {
        return openssl_decrypt($phone, "AES-128-ECB", env('ENCRYPTION_KEY'));
    }

    public function setAddressAttribute($address) {
        $this->attributes['address'] = openssl_encrypt($address, "AES-128-ECB", env('ENCRYPTION_KEY'));
    }

    public function getAddressAttribute($address) {
        return openssl_decrypt($address, "AES-128-ECB", env('ENCRYPTION_KEY'));
    }

    public function getIdAttribute($id) {
        return (String)$id;
    }

}
