<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarDetail extends Model
{
    use HasFactory;

    protected $table = 'car_detail';

    protected $fillable = [
        'car_id',
        'gara_id',
        'author_id',
        'category_detail_id',
        'publish_date',
        'status',
        'describe',
    ];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }

    public function category_detail()
    {
        return $this->belongsTo(CategoryDetail::class, 'category_detail_id');
    }

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function scopePaginate($query, $paginate)
    {
        $query = $query->paginate($paginate);
    }
}
