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
        box-shadow: 0 0 2px rgba(0,0,0,0.2);
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
        box-shadow: 0 0 6px rgba(0,0,0,0.3);
    }

    .color-link.active {
        border-color: #000;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.4);
    }

    .color-link::after {
        content: attr(data-color);
        position: absolute;
        bottom: -20px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 12px;
        color: #333;
        white-space: nowrap;
    }

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

    .radio-container input[type="radio"]:checked + .size-label {
        background-color: #000;
        color: #fff;
        border-color: #000;
    }

    .radio-container input[type="radio"]:disabled + .size-label {
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


</style>
@endpush

@section('content')
<div class="container product-detail-page" style="padding-top: 100px; padding-bottom: 50px;">
    <div class="row">
        {{-- Cột hình ảnh --}}
        <div class="col-md-8">
            <div class="product-gallery">
                <img id="main-product-image" src="{{ Storage::url($product->image_url) }}" alt="{{ $product->name }}" class="img-fluid w-100">
            </div>
        </div>

        {{-- Cột thông tin và lựa chọn --}}
        <div class="col-md-4">
            <div class="product-summary">
                <h1 class="product_title entry-title">{{ $product->name }}</h1>
                <p class="price">
                    @if($product->sale_price && $product->sale_price > 0)
                        <del><span>{{ number_format($product->base_price, 0, ',', '.') }}₫</span></del>
                        <ins><span>{{ number_format($product->sale_price, 0, ',', '.') }}₫</span></ins>
                    @else
                        <span>{{ number_format($product->base_price, 0, ',', '.') }}₫</span>
                    @endif
                </p>

                <form class="cart" action="#" method="post">
                    @csrf
                    <input type="hidden" name="variant_id" id="selected_variant_id" value="">

                    {{-- Màu sắc --}}
                    <div class="variant-group">
                        <label>Màu sắc:</label>
                        <div class="color-selector">
                            @foreach($uniqueColors as $color)
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
                    @if($selectedColor && $sizesForSelectedColor->isNotEmpty())
                        <div class="variant-group" id="size-group">
                            <label>Kích cỡ:</label>
                            <div class="size-selector" id="size-selector-container">
                                @foreach($sizesForSelectedColor as $variant)
                                    <div class="radio-container">
                                        <input type="radio"
                                               name="variant_id"
                                               id="size_{{ $variant->variant_id }}"
                                               value="{{ $variant->variant_id }}"
                                               {{ $variant->stock_quantity <= 0 ? 'disabled' : '' }}>
                                        <label for="size_{{ $variant->variant_id }}" class="size-label">{{ $variant->size }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Số lượng --}}
                    <div class="variant-group">
    <label>Số lượng:</label>
    <div class="quantity-wrapper">
        <button type="button" class="qty-btn" onclick="changeQty(-1)">−</button>
        <input type="number" name="quantity" id="quantity-input" class="qty-input" value="1" min="1">
        <button type="button" class="qty-btn" onclick="changeQty(1)">+</button>
    </div>
</div>


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
<script>
    function changeQty(amount) {
        const input = document.getElementById('quantity-input');
        let current = parseInt(input.value) || 1;
        current += amount;
        if (current < 1) current = 1;
        input.value = current;
    }
</script>
@endpush
