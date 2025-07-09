<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of products
     */
    public function index()
    {
        $products = Product::with('category')->paginate(12);
        // This line already fetches categories, perfect!
        $categories = Category::withCount('products')->get();

        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Display the specified product
     */
    public function show(Product $product, Request $request): View
    {
        $product->load('variants');

        $selectedColor = $request->input('color');
        $uniqueColors = $product->variants->pluck('color')->unique();

        $sizesForSelectedColor = collect();
        if ($selectedColor) {
            $sizesForSelectedColor = $product->variants->where('color', $selectedColor);
        }

        // Lấy ảnh đại diện theo màu từ image_url_specific
        $colorImages = [];
        foreach ($uniqueColors as $color) {
            $variant = $product->variants->where('color', $color)->first();

            if ($variant && $variant->image_url_specific) {
                // Nếu ảnh là URL tuyệt đối (http), dùng trực tiếp
                if (Str::startsWith($variant->image_url_specific, ['http://', 'https://'])) {
                    $colorImages[$color] = $variant->image_url_specific;
                } else {
                    // Ngược lại, là đường dẫn từ thư mục public/
                    $colorImages[$color] = asset($variant->image_url_specific);
                }
            } else {
                $colorImages[$color] = asset('assets/images/default.jpg');
            }
        }

        return view('client.products.show', compact(
            'product',
            'uniqueColors',
            'selectedColor',
            'sizesForSelectedColor',
            'colorImages'
        ));
    }

    /**
     * Search products
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        $category = $request->get('category');
        $sort = $request->get('sort', 'newest');

        $products = Product::with('category');

        if ($query) {
            $products->where('name', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")
                ->orWhere('brand', 'like', "%{$query}%");
        }

        if ($category) {
            $products->where('category_id', $category);
        }

        // Apply sorting
        switch ($sort) {
            case 'price-asc':
                $products->orderBy('base_price', 'asc');
                break;
            case 'price-desc':
                $products->orderBy('base_price', 'desc');
                break;
            case 'name-asc':
                $products->orderBy('name', 'asc');
                break;
            case 'name-desc':
                $products->orderBy('name', 'desc');
                break;
            case 'newest':
            default:
                $products->orderBy('created_at', 'desc');
                break;
        }

        $products = $products->paginate(12);
        $categories = Category::withCount('products')->get();

        return view('products.search', compact('products', 'categories', 'query', 'category', 'sort'));
    }
}
