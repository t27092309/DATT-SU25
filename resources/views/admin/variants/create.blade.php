@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h2 required style="background-color: white; color: black;">Thêm biến thể sản phẩm</h2>

    <form action="{{ route('admin.variants.store') }}" method="POST">
        @csrf
        @include('admin.variants.form')
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
</div>
@endsection
