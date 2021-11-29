<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $table = 'products';

    public $primaryKey = 'id';

    protected $guarded = [];

    public function orderItems(){
        return $this->hasMany('App\Models\OrderItem','product_id');
    }
}
