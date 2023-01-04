<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class card extends Model
{
    use SoftDeletes;

    use HasFactory;
    protected $table = 'card';

    protected $fillable = [
        'card_id',
        'user_id',
        'status',
        
    ];

    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
