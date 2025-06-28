<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request; // Thêm dòng này để sử dụng Request
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
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

}
