@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Tạo Danh mục Mới</h1>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay lại Danh sách</a>
    </div>

    <div class="card bg-dark text-white rounded-3">
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf {{-- CSRF token cho bảo mật --}}

                <div class="mb-3">
                    <label for="name" class="form-label">Tên Danh mục:</label>
                    <input type="text" class="form-control bg-secondary text-white border-0 @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Thêm Danh mục</button>
            </form>
        </div>
    </div>
</div>
@endsection