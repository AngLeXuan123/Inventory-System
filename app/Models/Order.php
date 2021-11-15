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

    
}
