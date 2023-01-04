<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    use HasFactory;
    protected $table = 'cart_detail';

    protected $fillable = ['cart_id','car_id'];

    public function cart()
    {
        return $this->belongsTo(Cart::class,'cart_id');
    }

    public function car()
    {
        return $this->belongsTo(Car::class,'car_id');
    }


    public function scopeWhereCarId($query, $carId)
    {
        $query = $query->where('car_id', $carId);
    }
}
