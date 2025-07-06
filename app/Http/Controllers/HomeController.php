<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        //lấy toàn bộ sản phẩm
        $allProducts = Product::all();
        // Lấy sản phẩm mới nhất (theo ngày tạo)
        $newProducts = Product::orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        // Lấy sản phẩm bán chạy (theo sold_quantity cao nhất)
        $bestSellers = Product::orderBy('sold_quantity', 'desc')
            ->take(8)
            ->get();
        
        //Tổng sản phẩm đã bán
        $totalQuantity = Product::sum('sold_quantity');

        //Tổng số khách hàng đã mua hàng
        $totalCustomers = User::count();
        

        return view('home', compact('allProducts', 'newProducts', 'bestSellers', 'totalQuantity' , 'totalCustomers'));

    }
}
