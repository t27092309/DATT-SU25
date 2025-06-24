@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 style="color: #2A2F5B">Quản lý Danh mục</h1>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Thêm Danh mục Mới</a>
        </div>

        {{-- Hiển thị thông báo thành công --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

<div class="bg-white p-3 rounded shadow-sm"> {{-- bg-white: nền trắng, p-3: padding, rounded: bo góc, shadow-sm: shadow nhỏ --}}
        @if ($categories->isEmpty())
            <p class="text-dark">Chưa có danh mục nào.</p> {{-- Đảm bảo chữ tối trên nền trắng --}}
        @else
            <div class="table-responsive">
                {{-- Bảng không cần class bg-dark, text-white nữa vì đã có wrapper xử lý nền trắng --}}
                <table class="table text-dark"> {{-- Giữ text-dark hoặc dùng CSS tùy chỉnh --}}
                    <thead>
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Tên Danh mục</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td class="align-middle">{{ $category->category_id }}</td>
                            <td class="align-middle">{{ $category->name }}</td>
                            <td class="align-middle">
                                <a href="{{ route('admin.categories.edit', $category->category_id) }}" class="btn btn-sm btn-warning me-2">Sửa</a>
                                <form action="{{ route('admin.categories.destroy', $category->category_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');">Xóa</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    </div>
@endsection
