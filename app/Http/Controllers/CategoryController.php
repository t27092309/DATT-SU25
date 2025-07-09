<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories
     */
    public function index()
    {
        $categories = Category::withCount('products')->get();
        
        return view('categories.index', compact('categories'));
    }

    /**
     * Display products by category
     */
    public function show($slug)
    {
        // Tìm category theo slug (cần thêm slug vào migration)
        $category = Category::where('slug', $slug)->firstOrFail();
        
        $products = Product::where('category_id', $category->category_id)
            ->with('category')
            ->paginate(12);
        $allCategories = Category::all();
        
        return view('categories.show', compact('category', 'products', 'allCategories'));
    }

    /**
     * Display products by category ID
     */
    public function showById($id)
    {
        $category = Category::findOrFail($id);
        
        $products = Product::where('category_id', $category->category_id)
            ->with('category')
            ->paginate(12);
        $allCategories = Category::all();
        
        return view('categories.show', compact('category', 'products', 'allCategories'));
    }
} 