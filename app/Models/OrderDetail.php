<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_detail';

    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }

    public function car(){
        return $this->belongsTo(Car::class,'car_id');
    }

    public function token_give_car_back(){
        return $this->hasOne(GiveCarBack::class);
    }

    
}
