<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PaymentTokens extends Model
{
    use HasFactory;

    public function order(){
        return $this->belongsTo('App\Models\Order','order_id');
    }

    public function generateUniqueCode()
    {
        do {
            $codes = Str::random(30);
        } while (PaymentTokens::where("code", "=", $codes)->first());
  
        return $codes;
    }
    
}
