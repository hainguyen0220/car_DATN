<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'category';

    protected $fillable = ['category_name'];
    

    public function category_detail()
    {
        return $this->hasMany(CategoryDetail::class);
    }

    public function scopePaginate($query, $paginate){
        $query = $query->paginate($paginate);
    }


    public function scopeWithFilter($query, $category)
    {

        if ($category) {
            $query = $query->where('category_name', $category);
            return $query;
        }

        return $query;

        
    }


}
