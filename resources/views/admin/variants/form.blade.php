<div style="background-color: white; color: black; padding: 20px; border-radius: 8px;">
    
    <div class="mb-3">
        <label for="product_id" class="form-label">Sản phẩm</label>
        <select name="product_id" class="form-select" required style="background-color: white; color: black;">
            <option value="">--Chọn sản phẩm--</option>
            @foreach($products as $product)
                <option value="{{ $product->product_id }}" {{ old('product_id', $variant->product_id ?? '') == $product->product_id ? 'selected' : '' }}>
                    {{ $product->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Màu</label>
        <input type="text" name="color" class="form-control" value="{{ old('color', $variant->color ?? '') }}" required style="background-color: white; color: black;">
    </div>

    <div class="mb-3">
        <label class="form-label">Size</label>
        <input type="text" name="size" class="form-control" value="{{ old('size', $variant->size ?? '') }}" required style="background-color: white; color: black;">
    </div>

    <div class="mb-3">
        <label class="form-label">Tồn kho</label>
        <input type="number" name="stock_quantity" class="form-control" value="{{ old('stock_quantity', $variant->stock_quantity ?? 0) }}" required style="background-color: white; color: black;">
    </div>

    <div class="mb-3">
        <label class="form-label">Giá phụ trội</label>
        <input type="number" step="0.01" name="price_modifier" class="form-control" value="{{ old('price_modifier', $variant->price_modifier ?? 0) }}" required style="background-color: white; color: black;">
    </div>

    <div class="mb-3">
        <label class="form-label">Ảnh riêng (URL)</label>
        <input type="text" name="image_url_specific" class="form-control" value="{{ old('image_url_specific', $variant->image_url_specific ?? '') }}" style="background-color: white; color: black;">
    </div>

</div>
