<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiveCarBack extends Model
{
    use HasFactory;
    protected $table = 'token_give_car_back';
    protected $fillable = ['order_detail_id'];

    public function role()
    {
        return $this->belongsTo(OrderDetail::class, 'order_detail_id');
    }
}
