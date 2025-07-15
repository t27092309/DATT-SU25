<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;        // Đảm bảo bạn có model Order
use App\Models\OrderItem;    // Đảm bảo bạn có model OrderItem
use App\Models\ProductVariant; // Cần để kiểm tra lại tồn kho lần cuối
use Illuminate\Support\Facades\DB; // Để sử dụng database transaction
use Illuminate\Support\Facades\Auth; // Để lấy thông tin người dùng đăng nhập
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    /**
     * Display the checkout form with cart contents.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $cart = session()->get('cart', []);

        // Nếu giỏ hàng trống, chuyển hướng về trang giỏ hàng với thông báo
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống. Vui lòng thêm sản phẩm trước khi thanh toán.');
        }

        // Tùy chọn: Lấy thông tin người dùng nếu đã đăng nhập để điền vào form
        $user = Auth::user();

        return view('checkout.index', compact('cart', 'user'));
    }

    /**
     * Process the order, save to database, and clear cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processOrder(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:500',
            // Thêm các validation khác nếu cần
        ]);

        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        $totalAmount = 0;
        foreach ($cart as $item) {
            $totalAmount += $item['quantity'] * $item['price'];
        }

        try {
            // Tạo Order
            $order = new Order();
            if (Auth::check()) {
                $order->user_id = Auth::id();
            } else {
                $order->user_id = null; // Cho phép NULL cho khách chưa đăng nhập
            }
            $order->customer_name = $request->input('customer_name');
            $order->customer_email = $request->input('customer_email');
            $order->customer_phone = $request->input('customer_phone');
            $order->shipping_address = $request->input('shipping_address');
            $order->total_amount = $totalAmount;
            $order->status = 'pending';
            $order->notes = $request->input('notes', null); // Lấy ghi chú nếu có
            $order->save();

            // Tạo OrderItems
            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->order_id, // Sử dụng ID của order vừa tạo
                    'product_variant_id' => $item['variant_id'],
                    'quantity' => $item['quantity'],
                    'price_per_unit' => $item['price'], // Lấy giá từ giỏ hàng
                    'product_name_snapshot' => $item['name'], // Lấy tên sản phẩm từ giỏ hàng
                    'variant_color_snapshot' => $item['color'], // Lấy màu từ giỏ hàng
                    'variant_size_snapshot' => $item['size'], // Lấy size từ giỏ hàng
                ]);
            }

            // Xóa giỏ hàng sau khi đặt hàng thành công
            Session::forget('cart');

            return redirect()->route('order.success')->with('success', 'Đơn hàng của bạn đã được đặt thành công!');
        } catch (\Exception $e) {
            \Log::error('Order creation failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi trong quá trình đặt hàng. Vui lòng thử lại.');
        }
    }

    /**
     * Display a success page after an order is placed.
     * (Cần tạo thêm route và view cho trang này)
     *
     * @return \Illuminate\View\View
     */
    public function success()
    {
        return view('checkout.success');
    }
}
