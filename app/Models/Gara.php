<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gara extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'gara';

    protected $fillable = ['name','email','address', 'describle'];

    public function scopePaginate($query, $paginate)
    {
        $query = $query->paginate($paginate);
    }


    public function scopeWithFilter($query, $filters)
    {
        [
            'gara_name' => $garaName,
            'email' => $email,
            'address' => $address,
        ] = $filters;

        if ($garaName) {
            $query = $query->where('name', 'like', '%' . $garaName . '%');
            return $query;
        }

        if ($email) {
            $query = $query->where('email', $email);
            return $query;
        }

        if ($address) {
            $query = $query->where('address', 'like', '%' . $address . '%');
            return $query;
        }

        return $query;
    }
}
