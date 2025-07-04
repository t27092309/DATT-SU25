<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function update(Request $request, $key)
    {
        $cart = session('cart', []);
        if (isset($cart[$key])) {
            $cart[$key]['quantity'] = $request->quantity;
            session(['cart' => $cart]);
        }
        return back()->with('success', 'Cập nhật số lượng thành công!');
    }

    public function remove($key)
    {
        $cart = session('cart', []);
        if (isset($cart[$key])) {
            unset($cart[$key]);
            session(['cart' => $cart]);
        }
        return back()->with('success', 'Xóa sản phẩm khỏi giỏ hàng thành công!');
    }
}