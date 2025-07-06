@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 required style="background-color: white; color: black;">Chỉnh sửa biến thể sản phẩm</h2>

    <form action="{{ route('admin.variants.update', $variant) }}" method="POST">
        @csrf @method('PUT')
        @include('admin.variants.form')
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
@endsection
