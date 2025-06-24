@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Chỉnh sửa Danh mục: {{ $category->name }}</h1>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay lại Danh sách</a>
    </div>

    <div class="card bg-dark text-white rounded-3">
        <div class="card-body">
            <form action="{{ route('admin.categories.update', $category->category_id) }}" method="POST">
                @csrf
                @method('PUT') {{-- Sử dụng phương thức PUT/PATCH cho cập nhật --}}

                <div class="mb-3">
                    <label for="name" class="form-label">Tên Danh mục:</label>
                    <input type="text" class="form-control bg-secondary text-white border-0 @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $category->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Cập nhật Danh mục</button>
            </form>
        </div>
    </div>
</div>
@endsection