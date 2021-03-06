<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    public $primaryKey = 'id';

    protected $guarded = [];

    public function orderItems(){
        return $this->hasMany('App\Models\OrderItem','order_id');
    }

    public function paymentToken(){
        return $this->hasOne('App\Models\PaymentTokens', 'order_id');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

}
