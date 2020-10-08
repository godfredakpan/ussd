<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Api\V1\Traits\UsesUuid;


class Order extends Model
{

    // use UsesUuid;

    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date_result_received','receipt_id', 'consumer_user_id', 'amount', 'delivery_address', 'delivery_time', 'delivery_date', 'salesNote', 'payment_date', 'payment_status', 'test_id', 'kit_id', 'is_bundle','sample_collection_date','sample_collection_time', 'order_status', 'pdf_link' , 'state'
    ];

    public function user()
    {
        return $this->belongsTo('App\Api\V1\Models\ConsumerUser');
    }

    public function order_detail()
    {
        return $this->belongsTo('App\Api\V1\Models\OrderDetail' , 'receipt_id');
    }

    public function getIdAttribute($id) {
        return (String)$id;
    }

    public function setDeliveryAddressAttribute($delivery_address) {
        $this->attributes['delivery_address'] = openssl_encrypt($delivery_address, "AES-128-ECB", env('ENCRYPTION_KEY'));
    }

    public function getDeliveryAddressAttribute($delivery_address) {
        return openssl_decrypt($delivery_address, "AES-128-ECB", env('ENCRYPTION_KEY'));
    }

    public function setSalesNoteAttribute($sales_note) {
        $this->attributes['salesNote'] = openssl_encrypt($sales_note, "AES-128-ECB", env('ENCRYPTION_KEY'));
    }

    public function getSalesNoteAttribute($sales_note) {
        return openssl_decrypt($sales_note, "AES-128-ECB", env('ENCRYPTION_KEY'));
    }

   /* public function setReceiptIdttribute($receipt_id) {
        $this->attributes['receipt_id'] = openssl_encrypt($receipt_id, "AES-128-ECB", env('ENCRYPTION_KEY'));
    }

    public function getReceiptIdAttribute($receipt_id) {
        return openssl_decrypt($receipt_id, "AES-128-ECB", env('ENCRYPTION_KEY'));
    }*/

}
