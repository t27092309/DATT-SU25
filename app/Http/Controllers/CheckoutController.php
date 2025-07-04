<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function showCart()
    {
        return view('cart');
    }

    public function checkout(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return back()->with('error', 'Giỏ hàng trống!');
        }

        $total = collect($cart)->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });

        $order = Order::create([
            'customer_name' => $request->customer_name,
            'email' => $request->email,
            'address' => $request->address,
            'total' => $total,
        ]);

        foreach ($cart as $item) {
            $order->orderItems()->create([
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);
        }

        session()->forget('cart');

        return redirect('/cart')->with('success', 'Thanh toán thành công!');
    }
}
