<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';

    protected $fillable = ['account_id'];
    
    public function cart_detail(){
        return $this->hasMany(CartDetail::class);
    }
   

    
}
