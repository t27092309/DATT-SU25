<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Add a product variant to the cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        // 1. Validate the incoming request data
        $request->validate([
            'variant_id' => 'required|numeric|exists:product_variants,variant_id', // Ensure variant_id exists and is numeric
            'quantity' => 'required|integer|min:1', // Quantity must be integer and at least 1
        ]);

        $variantId = $request->input('variant_id');
        $quantity = (int) $request->input('quantity'); // Cast to integer for safety

        // 2. Retrieve the product variant details from the database
        // Use with('product') to eager load the related product for details like name, image_url
        $variant = ProductVariant::with('product')->find($variantId);

        if (!$variant) {
            // This should ideally be caught by 'exists' validation rule, but good to double check
            return back()->with('error', 'Biến thể sản phẩm không tồn tại.');
        }

        // 3. Check for available stock
        if ($variant->stock_quantity <= 0) {
            return back()->with('error', 'Sản phẩm này hiện đã hết hàng.');
        }
        if ($variant->stock_quantity < $quantity) {
            return back()->with('error', 'Số lượng bạn yêu cầu vượt quá số lượng tồn kho hiện có (' . $variant->stock_quantity . ').');
        }

        // 4. Get the current cart from the session
        // If 'cart' session doesn't exist, it defaults to an empty array
        $cart = session()->get('cart', []);

        // 5. Add or update the item in the cart
        if (isset($cart[$variantId])) {
            // Item already in cart, just update quantity
            $newCartQuantity = $cart[$variantId]['quantity'] + $quantity;

            // Re-check stock with the combined quantity
            if ($newCartQuantity > $variant->stock_quantity) {
                return back()->with('error', 'Bạn không thể thêm số lượng này vì tổng số lượng trong giỏ hàng sẽ vượt quá tồn kho hiện có (' . $variant->stock_quantity . ').');
            }
            $cart[$variantId]['quantity'] = $newCartQuantity;
        } else {
            // Item not in cart, add as new entry
            $cart[$variantId] = [
                "name" => $variant->product->name, // Product name
                "color" => $variant->color,         // Variant color
                "size" => $variant->size,           // Variant size
                "quantity" => $quantity,
                "price" => $variant->price_modifier, // Sử dụng cột price_modifier của biến thể
                "image" => $variant->product->image_url, // Main product image or variant-specific image
                "variant_id" => $variant->variant_id, // Store variant ID for updates/removals
                "slug" => $variant->product->slug, // Store product slug for direct links from cart
            ];
        }

        // 6. Store the updated cart back into the session
        session()->put('cart', $cart);

        // 7. Redirect back or to the cart page with a success message
        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng thành công!');
        // Or to a dedicated cart page:
        // return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    }

    /**
     * Update the quantity of a specific item in the cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $key The key (variant_id) of the item to update
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $key)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session('cart', []);

        if (isset($cart[$key])) {
            $newQuantity = (int) $request->quantity;

            $variant = ProductVariant::find($key);
            if (!$variant) {
                return back()->with('error', 'Biến thể sản phẩm không tồn tại để cập nhật.');
            }

            if ($newQuantity > $variant->stock_quantity) {
                return back()->with('error', 'Số lượng bạn yêu cầu vượt quá số lượng tồn kho hiện có (' . $variant->stock_quantity . ').');
            }

            $cart[$key]['quantity'] = $newQuantity;
            session(['cart' => $cart]);

            return back()->with('success', 'Cập nhật số lượng thành công!');
        }

        return back()->with('error', 'Sản phẩm không tồn tại trong giỏ hàng.');
    }

    /**
     * Remove a specific item from the cart.
     *
     * @param  string  $key The key (variant_id) of the item to remove
     * @return \Illuminate\Http\Response
     */
    public function remove($key)
    {
        $cart = session('cart', []);

        if (isset($cart[$key])) {
            unset($cart[$key]);
            session(['cart' => $cart]);

            return back()->with('success', 'Xóa sản phẩm khỏi giỏ hàng thành công!');
        }

        return back()->with('error', 'Sản phẩm không tồn tại trong giỏ hàng để xóa.');
    }

    /**
     * Display the cart contents.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $cart = session('cart', []);
        return view('cart.index', compact('cart'));
    }
}
