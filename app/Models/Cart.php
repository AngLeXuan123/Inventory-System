<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';

    public $primaryKey = 'id';

    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }
}
