<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    public function index()
    {
        $variants = ProductVariant::with('product')->get();
        return view('admin.variants.index', compact('variants'));
    }

    public function create()
    {
        $products = Product::all();
        return view('admin.variants.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'color' => 'required|string|max:50',
            'size' => 'required|string|max:10',
            'stock_quantity' => 'required|integer|min:0',
            'price_modifier' => 'required|numeric',
            'image_url_specific' => 'nullable|string'
        ]);

        ProductVariant::create($request->all());
        return redirect()->route('admin.variants.index')->with('success', 'Thêm biến thể thành công!');
    }

    public function edit(ProductVariant $variant)
    {
        $products = Product::all();
        return view('admin.variants.edit', compact('variant', 'products'));
    }

    public function update(Request $request, ProductVariant $variant)
    {
        $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'color' => 'required|string|max:50',
            'size' => 'required|string|max:10',
            'stock_quantity' => 'required|integer|min:0',
            'price_modifier' => 'required|numeric',
            'image_url_specific' => 'nullable|string'
        ]);

        $variant->update($request->all());
        return redirect()->route('admin.variants.index')->with('success', 'Cập nhật biến thể thành công!');
    }

    public function destroy(ProductVariant $variant)
    {
        $variant->delete();
        return redirect()->route('admin.variants.index')->with('success', 'Xóa biến thể thành công!');
    }
}
