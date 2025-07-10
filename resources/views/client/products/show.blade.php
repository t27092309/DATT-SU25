@extends('layouts.app')

@push('styles')
    <style>
        .variant-group {
            margin-bottom: 25px;
        }

        .variant-group label {
            font-weight: 600;
            margin-bottom: 10px;
            display: block;
            font-size: 16px;
        }

        .color-selector {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            align-items: center;
        }

        .color-link {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            overflow: hidden;
            display: inline-block;
            padding: 0;
            border: 2px solid transparent;
            box-shadow: 0 0 2px rgba(0, 0, 0, 0.2);
            position: relative;
            transition: transform 0.2s ease;
        }

        .color-link img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            border-radius: 50%;
        }

        .color-link:hover {
            transform: scale(1.1);
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.3);
        }

        .color-link.active {
            border-color: #000;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.4);
        }

        /* Tắt tooltip màu nếu không cần hoặc muốn hiển thị khác */
        /* .color-link::after {
            content: attr(data-color);
            position: absolute;
            bottom: -20px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 12px;
            color: #333;
            white-space: nowrap;
        } */

        .size-selector {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .radio-container input[type="radio"] {
            display: none;
        }

        .radio-container .size-label {
            padding: 8px 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s;
            background-color: #fff;
        }

        .radio-container .size-label:hover {
            border-color: #000;
        }

        .radio-container input[type="radio"]:checked+.size-label {
            background-color: #000;
            color: #fff;
            border-color: #000;
        }

        .radio-container input[type="radio"]:disabled+.size-label {
            background-color: #eee;
            color: #999;
            cursor: not-allowed;
            text-decoration: line-through;
        }

        /* Số lượng sản phẩm đẹp */
        .quantity-wrapper {
            display: inline-flex;
            align-items: center;
            border: 1px solid #ccc;
            border-radius: 6px;
            background-color: #fff;
            overflow: hidden;
        }

        .qty-btn {
            width: 30px;
            height: 30px;
            border: none;
            background-color: #f0f0f0;
            font-size: 18px;
            font-weight: bold;
            color: #333;
            cursor: pointer;
            transition: background-color 0.2s;
            line-height: 1;
        }

        .qty-btn:hover {
            background-color: #ddd;
        }

        .qty-input {
            width: 40px;
            height: 30px;
            border: none;
            text-align: center;
            font-size: 15px;
            outline: none;
        }

        /* Alerts for success/error messages */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }

        .alert-danger {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }
    </style>
@endpush

@section('content')
    <div class="container product-detail-page" style="padding-top: 100px; padding-bottom: 50px;">
        <div class="row">
            {{-- Cột hình ảnh --}}
            <div class="col-md-8">
                <div class="product-gallery">
                    <img id="main-product-image" src="{{ Storage::url($product->image_url) }}" alt="{{ $product->name }}"
                        class="img-fluid w-100">
                </div>
            </div>

            {{-- Cột thông tin và lựa chọn --}}
            <div class="col-md-4">
                <div class="product-summary">
                    <h1 class="product_title entry-title">{{ $product->name }}</h1>
                    <p class="price">
                        @if ($product->sale_price && $product->sale_price > 0)
                            <del><span>{{ number_format($product->base_price, 0, ',', '.') }}₫</span></del>
                            <ins><span>{{ number_format($product->sale_price, 0, ',', '.') }}₫</span></ins>
                        @else
                            <span>{{ number_format($product->base_price, 0, ',', '.') }}₫</span>
                        @endif
                    </p>

                    {{-- Display success/error messages --}}
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- FORM THÊM VÀO GIỎ HÀNG --}}
                    <form class="cart" action="{{ route('cart.add') }}" method="post">
                        @csrf
                        {{-- <input type="hidden" name="variant_id" id="selected_variant_id" value=""> --}}
                        {{-- Loại bỏ input hidden vì giờ variant_id sẽ được gửi trực tiếp từ radio button --}}

                        {{-- Màu sắc --}}
                        <div class="variant-group">
                            <label>Màu sắc:</label>
                            <div class="color-selector">
                                @foreach ($uniqueColors as $color)
                                    <a href="{{ route('product.detail', ['product' => $product->slug, 'color' => $color]) }}"
                                        class="color-link {{ $selectedColor == $color ? 'active' : '' }}"
                                        data-color="{{ $color }}">
                                        <img src="{{ $colorImages[$color] ?? asset('assets/images/default.jpg') }}"
                                            alt="{{ $color }}">
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        {{-- Kích cỡ --}}
                        @if ($selectedColor && $sizesForSelectedColor->isNotEmpty())
                            <div class="variant-group" id="size-group">
                                <label>Kích cỡ:</label>
                                <div class="size-selector" id="size-selector-container">
                                    @foreach ($sizesForSelectedColor as $variant)
                                        <div class="radio-container">
                                            {{-- Đặt name là variant_id để gửi trực tiếp --}}
                                            <input type="radio" name="variant_id" id="size_{{ $variant->variant_id }}"
                                                value="{{ $variant->variant_id }}"
                                                {{ $variant->stock_quantity <= 0 ? 'disabled' : '' }}
                                                {{-- Nếu có biến thể nào đó được chọn mặc định, bạn có thể thêm logic `checked` ở đây --}}>
                                            <label for="size_{{ $variant->variant_id }}"
                                                class="size-label">{{ $variant->size }}
                                                @if ($variant->stock_quantity <= 0)
                                                    (Hết hàng)
                                                @endif
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                @if (
                                    $sizesForSelectedColor->where('stock_quantity', '>', 0)->isEmpty() &&
                                        $sizesForSelectedColor->isNotEmpty())
                                    <p class="text-danger mt-2">Tất cả các kích cỡ cho màu này hiện đang hết hàng.</p>
                                @endif
                            </div>
                        @else
                            <p class="text-danger">Không có kích cỡ nào cho màu sắc đã chọn.</p>
                        @endif

                        {{-- Số lượng --}}
                        <div class="variant-group">
                            <label>Số lượng:</label>
                            <div class="quantity-wrapper">
                                {{-- Bỏ onclick và JavaScript để giảm số lượng --}}
                                <input type="number" name="quantity" id="quantity-input" class="qty-input" value="1"
                                    min="1">
                                {{-- Bỏ onclick và JavaScript để tăng số lượng --}}
                            </div>
                            {{-- Bỏ thẻ small hiển thị tồn kho động --}}
                        </div>

                        {{-- Nút "Thêm vào giỏ hàng" --}}
                        {{-- Nút này sẽ luôn được bật, việc kiểm tra tồn kho và chọn variant_id sẽ do server xử lý --}}
                        <button type="submit" class="single_add_to_cart_button button alt">Thêm vào giỏ hàng</button>
                    </form>

                    <div class="woocommerce-product-details__short-description mt-4">
                        {!! $product->description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- Xóa toàn bộ khối JavaScript nếu bạn không muốn bất kỳ JS nào --}}
    {{-- Nếu bạn muốn giữ lại các hàm JS chung khác không liên quan đến việc chọn biến thể,
         thì hãy giữ chúng ở đây. Ví dụ như hàm gallery ảnh nếu có. --}}
@endpush