<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryDetail extends Model
{
    use HasFactory;

    protected $table = 'category_detail';

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['category_id','category_detail_name'];


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

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
            'category_detail' => $categoryDetail,
            'category_id' => $category_id,
        ] = $filters;

        if ($categoryDetail) {
            $query = $query->where('category_detail_name', 'like', '%' . $categoryDetail . '%');
        }


        if ($category_id) {
            $query = $query->where('category_id', $category_id);
        }

        return $query;
    }

    public function scopeWithFilterCategoryDetail($query, $categoryDetail)
    {

        if ($categoryDetail) {
            $query = $query->where('category_detail_name', $categoryDetail);
            return $query;
        }

        return $query;
    }
}
