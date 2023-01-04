<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

trait UpdateMessageTrait
{

    public function updateMessage(Request $request, $message, $messageType)
    {
        $request->session()->put('message', $message);
        $request->session()->put('messageType', $messageType);
    }

    public function updateFailMessage(Request $request, $message)
    {
        $this->updateMessage($request, $message, 'danger');
    }

    public function updateSuccessMessage(Request $request, $message)
    {
        $this->updateMessage($request, $message, 'success');
    }

    public function updateCountCard($request, $accountId)
    {
        $cart = Cart::with('cart_detail')->where('account_id', $accountId)->first();
        $countCartDetail = $cart->cart_detail->count();
        $request->session()->forget('countCartDetail');
        $request->session()->put('countCartDetail', $countCartDetail);
    }
}
