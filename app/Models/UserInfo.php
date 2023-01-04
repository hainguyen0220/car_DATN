<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserInfo extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $dates = ['deleted_at']; 

    protected $fillable = [
        'account_id',
        'full_name',
        'avatar',
        'dob',
        'address',
    ];
    
    protected $table = 'user_info';
    public function account(){
        return $this->belongsTo(Account::class,'account_id');
    }
}
