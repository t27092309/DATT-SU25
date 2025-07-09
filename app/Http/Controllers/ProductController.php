<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

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
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->with('category')->firstOrFail();
        
        // Get related products from same category
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('product_id', '!=', $product->product_id)
            ->with('category')
            ->limit(4)
            ->get();
        
        return view('products.show', compact('product', 'relatedProducts'));
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