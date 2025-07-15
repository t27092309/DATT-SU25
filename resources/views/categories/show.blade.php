@extends('layouts.app')

@section('title', $category->name . ' - Giày')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Sidebar Danh mục -->
        <div class="col-md-3 mb-4 mb-md-0">
            <h5 class="fw-bold mb-3">Danh mục sản phẩm</h5>
            <ul class="list-unstyled mb-4">
                @foreach($allCategories as $cat)
                <li class="mb-2">
                    <a href="{{ route('categories.show', $cat->slug) }}"
                        class="text-decoration-none {{ $cat->category_id == $category->category_id ? 'fw-bold text-primary' : 'text-dark' }}">
                        {{ strtoupper($cat->name) }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        <!-- End Sidebar -->

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
                <div class="mb-2 mb-md-0">
                    <select class="form-select d-inline-block w-auto">
                        <option>Thứ tự theo giá: thấp đến cao</option>
                        <option>Thứ tự theo giá: cao đến thấp</option>
                        <option>Mới nhất</option>
                        <option>Bán chạy</option>
                    </select>
                </div>
                <div class="text-muted small">{{ $products->total() }} products</div>
                <div class="d-flex align-items-center gap-2">
                    <button class="btn btn-light p-2"><i class="bi bi-grid"></i></button>
                    <button class="btn btn-light p-2"><i class="bi bi-list"></i></button>
                </div>
            </div>
            <hr>
            @if($products->count() > 0)
            <div class="row g-4">
                @foreach($products as $product)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="shoe-simple-card">
                        @if($product->is_on_sale)
                        <span class="shoe-simple-badge">{{ $product->discount_percentage }}%</span>
                        @endif
                        <img src="{{ $product->image_url }}" class="shoe-simple-img" alt="{{ $product->name }}">
                        <a href="/products/{{ $product->slug }}" class="shoe-simple-title">{{ $product->name }}</a>
                        <div class="shoe-simple-price">
                            @if($product->base_price > $product->current_price)
                            <span class="shoe-simple-price-old">{{ number_format($product->base_price) }}₫</span>
                            @endif
                            <span class="shoe-simple-price-new">{{ number_format($product->current_price) }}₫</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
            @else
            <div class="alert alert-info text-center py-5">
                <h5 class="mb-2">Không có giày nào</h5>
                <p class="mb-0">Chưa có giày nào trong danh mục này.</p>
                <a href="{{ route('categories.index') }}" class="btn btn-primary mt-3">Xem tất cả danh mục</a>
            </div>
            @endif
        </div>
        <!-- End Main Content -->
    </div>
</div>
<link rel="stylesheet" href="/css/shoecard-simple.css">
<style>
    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-card:hover {
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, .12) !important;
    }

    .product-card img:hover {
        transform: scale(1.04);
    }
</style>
@endsection