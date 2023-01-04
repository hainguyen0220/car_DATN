<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    const STATUS_BORROW = 0;
    const STATUS_CAR_PAID = 1;
    const STATUS_OBSOLETE = 2;
    const PAGINATE = 15;

    protected $table = 'order';

    protected $fillable = ['account_id'];

    public function order_detail()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public static function createOrder($accountId, $dataOrders)
    {
        $order = new Order();
        $order->account_id = $accountId;
        $order->save();
        $order->createOrderDetail($dataOrders)->deleteCart($accountId);
    }

    public function createOrderDetail($dataOrders)
    {
        $now = Carbon::now();
        $insertData = array_map(fn ($carId) => [
            'order_id' => $this->id,
            'car_id' => $carId->car_id,
            'quantity' => $carId->quantity,
            'status' => self::STATUS_BORROW,
            'date_order' => $now,
            'created_at' => $now,
            'updated_at' => null,
        ], $dataOrders);
        $listIdCar = array_map(fn ($car) => [
            $car['car_id'] => $car['quantity'],
        ], $insertData);

        OrderDetail::insert($insertData);

        foreach ($listIdCar as $car) {
            foreach ($car as $id => $quantity) {
                Order::updatecarAfterOrder($id, $quantity);
            }
        }

        return $this;
    }

    public function deleteCart($accountId)
    {
        $cartId = Cart::where('account_id', $accountId)->first()->id;
        $cartDetail = CartDetail::where('cart_id', '=', $cartId)->delete();
        return $this;
    }

    public static function updateCarAfterOrder($id, $quantity)
    {
        Car::where("id", $id)
            ->update(["total_quantity" => (int)Car::getQuantityById($id) - $quantity]);
        if ((int)Car::getQuantityById($id) === 2) {
            CartDetail::where("car_id", $id)->update([
                "status" => Car::OUT_OF_STOCK,
            ]);
        }
    }

    public static function isStock($quantityOrder, $carId)
    {
        $quantity = Car::find($carId)->total_quantity;
        if ((int)$quantity >= $quantityOrder) {
            return true;
        }
        return false;
    }

    public function scopePaginate($query, $paginate)
    {
        $query = $query->paginate($paginate);
    }

    public function scopeSearchWithDate($query, $filter)
    {
        [
            'date_start' => $dateStart,
            'date_end' => $dateEnd
        ] = $filter;

        if($dateStart){
            return $query->where('created_at','>=',$dateStart);
        }
        if($dateEnd){
            return $query->where('created_at','=<',$dateEnd);
        }

        return $query;
    }

    public static function isBorrow($status){
        if($status === self::STATUS_BORROW){
            return true;
        }
        return false;
    }

    public static function isCarPaid($status){
        if($status === self::STATUS_CAR_PAID){
            return true;
        }
        return false;
    }

    public static function isObsolete($status){
        if($status === self::STATUS_OBSOLETE){
            return true;
        }
        return false;
    }
}
