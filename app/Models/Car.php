<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Car extends Model
{
    use HasFactory;
    const STOCK = 'con';
    const OUT_OF_STOCK = 'het';
    const MIN_car = 0;
    const LIMIT_INDEX = 80;
    const SKIP_INDEX = 10;

    protected $table = 'car';

    protected $fillable = [
        'car_name',
            'number',
            'gara',
            'author',
            'category_detail',
            'publish_date',
            'status',
            'describle'

    ];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function car_detail()
    {
        return $this->hasOne(CarDetail::class);
    }

    public function cart_detail()
    {
        return $this->hasOne(CartDetail::class);
    }

    public function order_detail(){
        return $this->hasMany(OrderDetail::class);
    }

    public static function createCar($dataInsert, $image)
    {

        [
            'car_name' => $carName,
            'number' => $number,
        ] = $dataInsert;

        $car = new Car();
        $car->car_name = $carName;
        $car->total_quantity = $number;
        $car->image = $image;
        $car->save();

        $car->createCarDetail($dataInsert);
    }

    function createCarDetail($dataInsert)
    {
        [
            'gara' => $garaId,
            'author' => $authorId,
            'category_detail' => $categoryDetailId,
            'publish_date' => $publishDate,
            'status' => $status,
            'describle' => $describle,
        ] = $dataInsert;
        $carDetail = new CarDetail();
        $carDetail->car_id = $this->id;
        $carDetail->gara_id = $garaId;
        $carDetail->author_id = $authorId;
        $carDetail->category_detail_id = $categoryDetailId;
        $carDetail->publish_date = $publishDate;
        $carDetail->status = $status;
        $carDetail->describe = $describle;
        $carDetail->save();
        return $this;
    }


    public static function updateCar($id, $dataInsert, $image)
    {

        [
            'car_name' => $carName,
            'number' => $number,
            'gara' => $garaId,
            'author' => $authorId,
            'category_detail' => $categoryDetailId,
            'publish_date' => $publishDate,
            'status' => $status,
            'describle' => $describle,
        ] = $dataInsert;

        Car::where("id", $id)
            ->update([
                'car_name' => $carName,
                'total_quantity' => $number,
                'image' => $image,
            ]);

        if($number === 0){
            $status = self::OUT_OF_STOCK;
        }

        CartDetail::where("car_id", $id)
            ->update([
                'gara_id' => $garaId,
                'author_id' => $authorId,
                'category_detail_id' => $categoryDetailId,
                'publish_date' => $publishDate,
                'status' => $status,
                'describe' => $describle,
            ]);
    }

    public static function isStock($status)
    {
        if ($status === self::STOCK) {
            return true;
        }
        return false;
    }

    public static function findCarById($id){
        return Car::find($id)->car_name;
    }

    public static function getQuantityById($id){
        return Car::find($id)->total_quantity;
    }



    public function scopePaginate($query, $paginate)
    {
        $query = $query->paginate($paginate);
    }


    public function scopeWithFilterCarName($query, $carName)
    {
        if ($carName) {
            $query = $query->where('car_name', 'like', '%' . $carName . '%');
            return $query;
        }
        return $query;
    }



    public function scopeGetTenCar($query)
    {
        return $query = $query->limit(10);
    }

    public function scopeGetIndexCar($query)
    {
        return $query = $query->skip(self::SKIP_INDEX)
            ->limit(self::LIMIT_INDEX);
    }
}
