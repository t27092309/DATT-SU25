<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'base_price' => 'required|numeric',
            'category_id' => 'required|exists:categories,category_id',
            'sale_price' => 'nullable|numeric',
            'brand' => 'nullable|string|max:255',
            'sold_quantity' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        $imageUrl = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $imageUrl = 'products/' . basename($imagePath);
        }

        Product::create([
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['name']),
            'description' => $validatedData['description'],
            'brand' => $validatedData['brand'],
            'category_id' => $validatedData['category_id'],
            'sold_quantity' => $validatedData['sold_quantity'] ?? 0,
            'sale_price' => $validatedData['sale_price'],
            'base_price' => $validatedData['base_price'],
            'image_url' => $imageUrl,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Thêm sản phẩm thành công!');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'base_price' => 'required|numeric',
            'category_id' => 'required|exists:categories,category_id',
            'sale_price' => 'nullable|numeric',
            'brand' => 'nullable|string|max:255',
            'sold_quantity' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        $imageUrl = $product->image_url;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $imageUrl = 'products/' . basename($imagePath);
        }

        $product->update([
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['name']),
            'description' => $validatedData['description'],
            'brand' => $validatedData['brand'],
            'category_id' => $validatedData['category_id'],
            'sold_quantity' => $validatedData['sold_quantity'] ?? 0,
            'sale_price' => $validatedData['sale_price'],
            'base_price' => $validatedData['base_price'],
            'image_url' => $imageUrl,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Cập nhật sản phẩm thành công!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Xóa sản phẩm thành công!');
    }
}
