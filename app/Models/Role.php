<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory;

    use SoftDeletes;

    const ROLE_USER = 1;

    const ROLE_ADMIN = 2;

    protected $dates = ['deleted_at'];

    protected $table = 'role';
    
    public function account(){
        return $this->hasMany(Account::class);
    }
}
