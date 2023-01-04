<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Cart;
use App\Models\CartDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Throwable;

class CartController extends Controller
{
    use UpdateMessageTrait;
    const QUANTITY = 1;
    const OVER = 5;
    const MIN_CAR = 1;
    const PLUS = 'plus';
    const MINUS = 'minus';



    public function addCart(Request $request, $id)
    {
        $accountId = Auth::guard('account')->user()->id ?? (session('user')->id ?? null);
        if (!$accountId) {
            return redirect()->route('login');
        }
        $cart = Cart::with('cart_detail')->where('account_id', $accountId)->first();
        $cartDetails = $cart->cart_detail;
        $cartId = $cart->id;

        // try {
        //     if ($this->isAlreadyInCart($cartDetails, $id)) {
        //         $cartDetailUpdate = CartDetail::where('cart_id', $cartId)->whereCarId($id);
        //         $quantity =  $cartDetailUpdate->first()->quantity;
        //         if ($this->isOver($quantity)) {
        //             $this->updateFailMessage($request, __('message.add-card-over'));
        //             return back();
        //         }
        //         $cartDetailUpdate->update([
        //             'quantity' => $quantity + 1,
        //         ]);

        //         $this->updateCountCard($request, $accountId);

        //         $this->updateSuccessMessage($request, __('message.add-cart-successful'));
        //         return back();
        //     }

            $cartDetail = new CartDetail();
            $cartDetail->cart_id = $cartId;
            $cartDetail->car_id = $id;
            // $cartDetail->quantity = self::QUANTITY;
            $cartDetail->save();

            $this->updateCountCard($request, $accountId);
            $this->updateSuccessMessage($request, __('message.add-cart-successful'));
            return back();
        // } catch (Throwable $e) {
        //     log::channel('sql_log')->error($e->getMessage());
        //     $this->updateFailMessage($request, __('message.add-cart-fail'));
        //     return back();
        // }
    }

    public function showCart(Request $request)
    {
        $accountId = Auth::guard('account')->user()->id ?? (session('user')->id ?? null);
        if (!$accountId) {
            return redirect()->route('login');
        }
        $cart = Cart::with(['cart_detail.car.car_detail','cart_detail.car'=> function($query){
            $query->withTrashed();
        }])->where('account_id', $accountId)->first();
        $cartDetails = $cart->cart_detail;
        return view('user.cart.cart')->with(compact('cartDetails'));
    }

    public function updateCart(Request $request, $id, $type)
    {
        $cartDetail = CartDetail::where('id', $id);
        $quantity = $cartDetail->first()->quantity;
        if ($type === self::PLUS) {
            if ($quantity >= self::OVER) {
                $this->updateFailMessage($request, __('message.add-card-over'));
                return back();
            }
            $cartDetail->update([
                'quantity' => $quantity + 1,
            ]);
        }
        if ($type === self::MINUS) {
            if ($quantity > self::MIN_CAR) {
                $cartDetail->update([
                    'quantity' => $quantity - 1,
                ]);
            }
        }



        return back();
    }

    public function deleteCart(Request $request, $id)
    {
        $accountId = Auth::guard('account')->user()->id ?? (session('user')->id ?? null);

        if ($accountId) {
            try {
                $cartDetail = CartDetail::find($id);
                $cartDetail->delete();
                $this->updateCountCard($request, $accountId);
                $this->updateSuccessMessage($request, __('message.delete-cart-successful'));
                return back();
            } catch (Throwable $e) {
                log::channel('sql_log')->error($e->getMessage());
                $this->updateFailMessage($request, __('message.delete-cart-fail'));
                return back();
            }
        }
        return route('login');
    }

    public function isAlreadyInCart($cartDetails, $carId)
    {
        foreach ($cartDetails ?? [] as $cartDetail) {
            if ($cartDetail->car_id == $carId) {
                return true;
            }
        }
        return false;
    }

    public function isOver($quantity)
    {
        if ($quantity >= self::OVER) {
            return true;
        }

        return false;
    }
}
