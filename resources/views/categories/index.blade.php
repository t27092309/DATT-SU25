@extends('layouts.app')

@section('title', 'Danh mục giày')

@section('content')
<div class="container py-4">
    <div class="mb-4">
        <h1 class="display-5 fw-bold mb-2">Danh mục giày</h1>
        <p class="text-muted">Khám phá các loại giày đa dạng từ thể thao đến thời trang</p>
    </div>
    <div class="row g-4">
        @forelse($categories as $category)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="mb-3">
                        <h5 class="card-title mb-2">{{ $category->name }}</h5>
                        <span class="badge bg-primary">{{ $category->products_count }} sản phẩm</span>
                    </div>
                    <a href="{{ route('categories.show', $category->slug) }}" class="btn btn-outline-primary w-100 mt-auto">Xem giày</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center py-5">
                <h5 class="mb-2">Không có danh mục nào</h5>
                <p class="mb-0">Chưa có danh mục giày nào được tạo.</p>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection