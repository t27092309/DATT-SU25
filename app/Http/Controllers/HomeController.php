<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category; // Make sure to import the Category model
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        // Lấy toàn bộ sản phẩm
        $allProducts = Product::all();

        // Lấy sản phẩm mới nhất (theo ngày tạo)
        $newProducts = Product::orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        // Lấy sản phẩm bán chạy (theo sold_quantity cao nhất)
        $bestSellers = Product::orderBy('sold_quantity', 'desc')
            ->take(8)
            ->get();
        
        // Lấy toàn bộ danh mục sản phẩm, kèm theo số lượng sản phẩm trong mỗi danh mục
        // This is the crucial part to pass categories to your home view
        $categories = Category::withCount('products')->get(); 
        
        // Tổng sản phẩm đã bán
        $totalQuantity = Product::sum('sold_quantity');

        // Tổng số khách hàng đã mua hàng
        // Note: User::count() gives total users, not necessarily distinct customers who made a purchase.
        // If you need distinct customers who have made orders, you might need a more complex query
        // involving your orders table. For now, User::count() is fine if it aligns with your definition.
        $totalCustomers = User::count();
        

        return view('home', compact('allProducts', 'newProducts', 'bestSellers', 'categories', 'totalQuantity' , 'totalCustomers'));
    }
}