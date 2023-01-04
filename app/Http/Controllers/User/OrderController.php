<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UpdateMessageTrait;
use App\Models\Car;
use App\Models\Cart;
use App\Models\GiveCarBack;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\UserInfo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Throwable;

class OrderController extends Controller
{
    use UpdateMessageTrait;

    public function listOrder(Request $request)
    {
        $accountId = Auth::guard('account')->user()->id ?? (session('user')->id ?? null);
        if (!$accountId) {
            return redirect()->route('login');
        }
        $type = $request->type;

        $listOrders = Order::with(['order_detail.car.car_detail.author', 'order_detail.token_give_car_back', 'order_detail.car' => function ($query) {
            $query->withTrashed();
        }])
            ->where('account_id', $accountId)
            ->paginate(Order::PAGINATE);

        if ($type) {
            $type = ($type === 'STATUS_BORROW') ? Order::STATUS_BORROW : (($type === 'STATUS_CAR_PAID') ? Order::STATUS_CAR_PAID : Order::STATUS_OBSOLETE);
            $listOrders = Order::where('account_id', $accountId)->with(['order_detail' => function ($query)  use ($type) {
                $query->where('status', $type);
            }, 'order_detail.car' => function ($query) {
                $query->withTrashed();
            }])
            ->paginate(Order::PAGINATE);
        }
        return view('user.order.list_order')->with(compact('listOrders'));
    }


    public function showOrder(Request $request)
    {
        $accountId = Auth::guard('account')->user()->id ?? (session('user')->id ?? null);
        if (!$accountId) {
            return redirect()->route('login');
        }
        $info = UserInfo::with('account')->where('account_id', $accountId)->first();
        $cart = Cart::with('cart_detail.car.car_detail')->where('account_id', $accountId)->first();
        $cartDetails = $cart->cart_detail;
        foreach ($cartDetails as $cartDetail) {
            if ($cartDetail->car === null) {
                $this->updateFailMessage($request, __('message.delete-car-not-found'));
                return back();
            }
        }
        $count = 0;
        foreach ($cartDetails as $a) {
            $count += $a->quantity;
        }
        return view('user.order.order')->with(compact('cartDetails', 'info', 'count'));
    }


    public function order(Request $request)
    {
        $accountId = Auth::guard('account')->user()->id ?? (session('user')->id ?? null);
        if (!$accountId) {
            return redirect()->route('login');
        }
        $cart = Cart::with('cart_detail')->where('account_id', $accountId)->first();
        $cartDetails = $cart->cart_detail;
        $dataOrders = [];
        foreach ($cartDetails as $index => $cartDetail) {
            if (!(Order::isStock($cartDetail->quantity, $cartDetail->car_id))) {
                $this->updateFailMessage($request, 'Ô tô ' . Car::findCarById($cartDetail->car_id) . ' không đủ số lượng vui lòng xóa hoặc giảm số lượng');
                return back();
            }
            $dataOrders[$index] = $cartDetail;
        }

        try {
            Order::createOrder($accountId, $dataOrders);
            $this->updateSuccessMessage($request, __('message.order-successful'));
            $this->updateCountCard($request, $accountId);
            return redirect()->route('show.cart');
        } catch (Throwable $e) {
            log::channel('user_log')->error($e->getMessage());
            $this->updateFailMessage($request, __('message.order-fail'));
            return back();
        }
    }

    public function giveCarBack(Request $request, $id)
    {
        try {
            $token = GiveCarBack::where('order_detail_id', $id)->first();
            if ($token) {
                $this->updateFailMessage($request, __('message.give-car-back-fail'));
                return back();
            }
            GiveCarBack::create([
                'order_detail_id' => $id,
            ]);
            $this->updateSuccessMessage($request, __('message.give-car-back-successful'));
            return back();
        } catch (Throwable $e) {
            $this->updateFailMessage($request, __('message.give-car-back-fail'));
            return back();
        }
    }
}
