<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use HasFactory;

    protected $table = 'author';

    protected $fillable = [
        'full_name',
        'dob',
        'address',
        'describle',
    ];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function car_detail()
    {
        return $this->hasMany(CarDetail::class);
    }

    public function scopePaginate($query, $paginate)
    {
        $query = $query->paginate($paginate);
    }


    public function scopeWithFilter($query, $filters)
    {
        [
            'author_name' => $authorName,
            'year_birth' => $yearBirth,
            'address' => $address,
        ] = $filters;

        if ($authorName) {
            $query = $query->where('full_name', 'like', '%' . $authorName . '%');
            return $query;
        }

        if ($yearBirth) {
            $query = $query->where('dob', $yearBirth);
            return $query;
        }

        if ($address) {
            $query = $query->where('address', 'like', '%' . $address . '%');
            return $query;
        }

        return $query;
    }
}
