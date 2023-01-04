<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserActive extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $table = 'user_active';

    protected $fillable = [
        'account_id',
        'active_token',
    ];

    public function account(){
        return $this->belongsTo(Account::class,'account_id');
    }
}
