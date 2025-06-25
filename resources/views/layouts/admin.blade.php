<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - @yield('title', 'Your App Name')</title> {{-- Thêm title động --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <div class="wrapper">
        <div class="sidebar">
            <ul class="nav flex-column">
                {{-- Để làm active đúng, bạn có thể kiểm tra route hiện tại --}}
                <li class="nav-item">
                    {{-- <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="fa-solid fa-house"></i>
                        Dashboard
                    </a> --}}

                </li>

                <li class="nav-item components-header">COMPONENTS</li>

                <li class="nav-item">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.base.*') ? 'active' : '' }}"
                        href="#baseSubmenu" data-bs-toggle="collapse" role="button"
                        aria-expanded="{{ request()->routeIs('admin.base.*') ? 'true' : 'false' }}"
                        aria-controls="baseSubmenu">
                        <i class="fa-solid fa-layer-group"></i>
                        Base
                    </a>
                    <div class="collapse sub-menu {{ request()->routeIs('admin.base.*') ? 'show' : '' }}"
                        id="baseSubmenu">
                        <ul class="nav flex-column">
                            <li class="nav-item"><a class="nav-link" href="#">Alerts</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Badges</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.sidebar-layouts.*') ? 'active' : '' }}"
                        href="#sidebarLayoutsSubmenu" data-bs-toggle="collapse" role="button"
                        aria-expanded="{{ request()->routeIs('admin.sidebar-layouts.*') ? 'true' : 'false' }}"
                        aria-controls="sidebarLayoutsSubmenu">
                        <i class="fa-solid fa-grip-lines"></i>
                        Sidebar Layouts
                    </a>
                    <div class="collapse sub-menu {{ request()->routeIs('admin.sidebar-layouts.*') ? 'show' : '' }}"
                        id="sidebarLayoutsSubmenu">
                        <ul class="nav flex-column">
                            <li class="nav-item"><a class="nav-link" href="#">Default</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Fixed</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.forms.*') ? 'active' : '' }}"
                        href="#formsSubmenu" data-bs-toggle="collapse" role="button"
                        aria-expanded="{{ request()->routeIs('admin.forms.*') ? 'true' : 'false' }}"
                        aria-controls="formsSubmenu">
                        <i class="fa-solid fa-pen-to-square"></i>
                        Forms
                    </a>
                    <div class="collapse sub-menu {{ request()->routeIs('admin.forms.*') ? 'show' : '' }}"
                        id="formsSubmenu">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                {{-- Để 'Basic Form' active, kiểm tra route cụ thể --}}
                                <a class="nav-link {{ request()->routeIs('admin.forms.basic') ? 'active' : '' }}"
                                    href="#">
                                    <i class="fa-solid fa-circle me-2" style="font-size: 0.5em;"></i> Basic Form
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.tables.*') ? 'active' : '' }}"
                        href="#tablesSubmenu" data-bs-toggle="collapse" role="button"
                        aria-expanded="{{ request()->routeIs('admin.tables.*') ? 'true' : 'false' }}"
                        aria-controls="tablesSubmenu">
                        <i class="fa-solid fa-table"></i>
                        Tables
                    </a>
                    <div class="collapse sub-menu {{ request()->routeIs('admin.tables.*') ? 'show' : '' }}"
                        id="tablesSubmenu">
                        <ul class="nav flex-column">
                            <li class="nav-item"><a class="nav-link" href="#">Simple Tables</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.maps.*') ? 'active' : '' }}"
                        href="#mapsSubmenu" data-bs-toggle="collapse" role="button"
                        aria-expanded="{{ request()->routeIs('admin.maps.*') ? 'true' : 'false' }}"
                        aria-controls="mapsSubmenu">
                        <i class="fa-solid fa-map-location-dot"></i>
                        Maps
                    </a>
                    <div class="collapse sub-menu {{ request()->routeIs('admin.maps.*') ? 'show' : '' }}"
                        id="mapsSubmenu">
                        <ul class="nav flex-column">
                            <li class="nav-item"><a class="nav-link" href="#">Google Maps</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.charts.*') ? 'active' : '' }}"
                        href="#chartsSubmenu" data-bs-toggle="collapse" role="button"
                        aria-expanded="{{ request()->routeIs('admin.charts.*') ? 'true' : 'false' }}"
                        aria-controls="chartsSubmenu">
                        <i class="fa-solid fa-chart-bar"></i>
                        Charts
                    </a>
                    <div class="collapse sub-menu {{ request()->routeIs('admin.charts.*') ? 'show' : '' }}"
                        id="chartsSubmenu">
                        <ul class="nav flex-column">
                            <li class="nav-item"><a class="nav-link" href="#">Chart.js</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.widgets') ? 'active' : '' }}" href="#">
                        <i class="fa-solid fa-tv"></i>
                        Widgets
                        <span class="badge">4</span>
                        {{-- Mũi tên dropdown chỉ hiện nếu có submenu ẩn --}}
                        {{-- <i class="fa-solid fa-angle-down ms-auto"></i> --}}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.documentation') ? 'active' : '' }}"
                        href="#">
                        <i class="fa-solid fa-file-alt"></i>
                        Documentation
                        <span class="badge">1</span>
                        {{-- Mũi tên dropdown chỉ hiện nếu có submenu ẩn --}}
                        {{-- <i class="fa-solid fa-angle-down ms-auto"></i> --}}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.menu-levels.*') ? 'active' : '' }}"
                        href="#menuLevelsSubmenu" data-bs-toggle="collapse" role="button"
                        aria-expanded="{{ request()->routeIs('admin.menu-levels.*') ? 'true' : 'false' }}"
                        aria-controls="menuLevelsSubmenu">
                        <i class="fa-solid fa-bars"></i>
                        Menu Levels
                    </a>
                    <div class="collapse sub-menu {{ request()->routeIs('admin.menu-levels.*') ? 'show' : '' }}"
                        id="menuLevelsSubmenu">
                        <ul class="nav flex-column">
                            <li class="nav-item"><a class="nav-link" href="#">Level 1</a></li>
                        </ul>
                    </div>
                </li>

                {{-- Thêm liên kết đến CRUD danh mục của bạn --}}
              {{-- Danh mục --}}
<li class="nav-item">
   <a href="{{ route('admin.categories.index') }}" class="nav-link dropdown-toggle">
        <i class="fa-solid fa-list-alt"></i>
        Danh mục
    </a>
    <div class="collapse sub-menu {{ request()->routeIs('admin.categories.*') ? 'show' : '' }}" id="categoriesSubmenu">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.categories.index') ? 'active' : '' }}"
                    href="{{ route('admin.categories.index') }}">
                    <i class="fa-solid fa-circle me-2" style="font-size: 0.5em;"></i> Danh sách
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.categories.create') ? 'active' : '' }}"
                    href="{{ route('admin.categories.create') }}">
                    <i class="fa-solid fa-circle me-2" style="font-size: 0.5em;"></i> Thêm mới
                </a>
            </li>
        </ul>
    </div>
</li>

{{-- Sản phẩm --}}
<li class="nav-item">
 <a href="{{ route('admin.products.index') }}" class="nav-link dropdown-toggle" > 
   <i class="fa-solid fa-box"></i>  Sản Phẩm</a>
 
    <div class="collapse sub-menu {{ request()->routeIs('admin.products.*') ? 'show' : '' }}" id="productsSubmenu">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.products.index') ? 'active' : '' }}"
                    href="{{ route('admin.products.index') }}">
                    <i class="fa-solid fa-circle me-2" style="font-size: 0.5em;"></i> Danh sách
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.products.create') ? 'active' : '' }}"
                    href="{{ route('admin.products.create') }}">
                    <i class="fa-solid fa-circle me-2" style="font-size: 0.5em;"></i> Thêm mới
                </a>
            </li>
        </ul>
    </div>
</li>

{{-- Biến thể sản phẩm products --}}
<li class="nav-item">
 <a href="{{ route('admin.variants.index') }}" class="nav-link dropdown-toggle" > 
   <i class="fa-solid fa-box"></i>  Sản Phẩm Biến Thể</a>
 
    <div class="collapse sub-menu {{ request()->routeIs('admin.variants.*') ? 'show' : '' }}" id="productsSubmenu">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.variants.index') ? 'active' : '' }}"
                    href="{{ route('admin.variants.index') }}">
                    <i class="fa-solid fa-circle me-2" style="font-size: 0.5em;"></i> Danh sách
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.variants.create') ? 'active' : '' }}"
                    href="{{ route('admin.variants.create') }}">
                    <i class="fa-solid fa-circle me-2" style="font-size: 0.5em;"></i> Thêm mới
                </a>
            </li>
        </ul>
    </div>
</li>
            </ul>
        </div>

        <div class="main-content">
            @yield('content') {{-- Đây là nơi nội dung của các view con sẽ được chèn vào --}}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlco4jF7ewWVxzeYKoF7PNzKvxQ6zXKEpmSMjOrjgpFzobg" crossorigin="anonymous">
    </script>
    <script>
        // Optional: JavaScript để cuộn sidebar nếu có quá nhiều mục
        document.addEventListener('DOMContentLoaded', function() {
            var activeLink = document.querySelector('.sidebar .nav-link.active');
            if (activeLink) {
                activeLink.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        });
    </script>
</body>

</html>
<style>
    body {
        background-color: #b1b1b1;
        /* Dark purple background from the image */
        color: #ffffff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        /* Font for better readability */
    }

    .wrapper {
        display: flex;
        min-height: 100vh;
    }

    .sidebar {
        width: 250px;
        /* Chiều rộng cố định của sidebar */
        background-color: #1A2035;
        /* Match body background */
        padding: 20px 0;
        flex-shrink: 0;
        /* Ngăn sidebar bị co lại */
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
        /* Thêm bóng nhẹ */
    }

    .sidebar .nav-link {
        color: #ffffff;
        padding: 10px 20px;
        display: flex;
        align-items: center;
        transition: all 0.2s ease-in-out;
        /* Hiệu ứng chuyển động mượt */
        font-size: 0.95rem;
    }

    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
        background-color: #554d76;
        /* Slightly lighter purple for hover/active */
        border-left: 5px solid #8e44ad;
        /* Purple line on active/hover */
        padding-left: 15px;
        /* Adjust padding due to border */
    }

    .sidebar .nav-link i {
        margin-right: 12px;
        /* Tăng khoảng cách giữa icon và text */
        width: 20px;
        /* Ensure consistent icon spacing */
        text-align: center;
    }

    .sidebar .components-header {
        color: #b0a9cb;
        /* Lighter gray for "COMPONENTS" */
        font-size: 0.8em;
        /* Nhỏ hơn một chút */
        padding: 15px 20px 5px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        /* Tăng khoảng cách chữ */
        font-weight: 600;
    }

    .sidebar .sub-menu .nav-item {
        padding-left: 40px;
        /* Indent sub-menu items */
    }

    .sidebar .sub-menu .nav-link {
        font-size: 0.88em;
        /* Nhỏ hơn chút cho sub-menu */
        padding-top: 5px;
        padding-bottom: 5px;
        opacity: 0.8;
        /* Làm mờ hơn chút */
    }

    .sidebar .sub-menu .nav-link:hover {
        opacity: 1;
    }

    .sidebar .sub-menu .nav-link.active {
        font-weight: bold;
        color: #ffffff;
        background-color: transparent;
        /* No background on sub-menu active */
        border-left: none;
        /* No border on sub-menu active */
        opacity: 1;
    }

    .sidebar .badge {
        margin-left: auto;
        /* Push badge to the right */
        background-color: #3498db;
        /* Blue for badges */
        color: white;
        border-radius: 50%;
        width: 25px;
        height: 25px;
        min-width: 25px;
        /* Đảm bảo kích thước tối thiểu */
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 0.75em;
        /* Kích thước chữ nhỏ hơn */
        font-weight: bold;
        line-height: 1;
        /* Căn giữa text theo chiều dọc */
    }

    .sidebar .dropdown-toggle::after {
        margin-left: auto;
        /* Push arrow to the right */
        vertical-align: middle;
        transition: transform 0.2s ease-in-out;
    }

    .sidebar .nav-item .dropdown-toggle.collapsed::after {
        transform: rotate(0deg);
    }

    .sidebar .nav-item .dropdown-toggle:not(.collapsed)::after {
        transform: rotate(180deg);
        /* Xoay mũi tên khi mở */
    }

    .sidebar .nav-item .dropdown-toggle {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }


    .main-content {
        flex-grow: 1;
        padding: 20px;
        background-color: #F5F7FD;
        /* Nền tối hơn cho phần nội dung chính */
    }

    /* Style cho card trong content */
    .card.bg-dark {
        background-color: #b1b1b1 !important;
        /* Đảm bảo card cũng có màu tương tự sidebar */
    }

    /* Custom CSS for tables with light background */
    .main-content .table {
        color: #333333;
        /* Màu chữ tối cho nội dung bảng */
        background-color: #ffffff;
        /* Nền trắng cho toàn bộ bảng */
        border: 1px solid #dee2e6;
        /* Đường viền nhẹ cho bảng */
        border-radius: 0.5rem;
        /* Bo tròn góc cho bảng, tùy chọn */
        overflow: hidden;
        /* Quan trọng để border-radius hoạt động với các ô */
    }

    .main-content .table thead {
        background-color: #e9ecef;
        /* Màu nền nhẹ hơn cho tiêu đề bảng */
        color: #333333;
        /* Đảm bảo màu chữ tối cho tiêu đề */
    }

    .main-content .table th {
        border-bottom: 2px solid #dee2e6;
        /* Đường viền dưới đậm hơn cho tiêu đề */
        padding: 0.75rem;
        /* Padding cho tiêu đề */
    }

    .main-content .table td {
        border-top: 1px solid #dee2e6;
        /* Đường viền trên cho các ô */
        padding: 0.75rem;
        /* Padding cho các ô dữ liệu */
    }

    /* Optional: Thêm hiệu ứng hover nếu bạn muốn */
    .main-content .table.table-hover tbody tr:hover {
        background-color: #f8f9fa;
        /* Màu nền khi hover */
    }

    /* Optional: Thêm hiệu ứng sọc nếu bạn muốn */
    .main-content .table.table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 0, 0, 0.03);
        /* Màu nền cho hàng lẻ, hơi nhạt hơn nền trắng */
    }

    /* Điều chỉnh lại màu nút và card để phù hợp với theme tổng thể nếu cần */
    .main-content .btn-warning {
        background-color: #ffc107;
        /* Màu vàng của Bootstrap */
        border-color: #ffc107;
        color: #212529;
        /* Chữ đen trên nền vàng */
    }

    .main-content .btn-warning:hover {
        background-color: #e0a800;
        border-color: #e0a800;
    }

    .main-content .btn-danger {
        background-color: #dc3545;
        /* Màu đỏ của Bootstrap */
        border-color: #dc3545;
        color: #fff;
        /* Chữ trắng trên nền đỏ */
    }

    .main-content .btn-danger:hover {
        background-color: #c82333;
        border-color: #c82333;
    }

    .main-content .btn-primary {
        background-color: #0d6efd;
        /* Màu xanh của Bootstrap */
        border-color: #0d6efd;
        color: #fff;
    }

    .main-content .btn-primary:hover {
        background-color: #0b5ed7;
        border-color: #0a58ca;
    }

    /* Điều chỉnh màu sắc cho Card trong main-content để phù hợp với theme tối */
    .main-content .card {
        background-color: #3f395b !important;
        /* Đảm bảo card cũng có màu tương tự sidebar */
        color: #ffffff;
        /* Màu chữ trắng */
        border: none;
        /* Bỏ viền mặc định của card */
    }

    .main-content .card-header {
        background-color: #4b4566 !important;
        /* Màu nền cho header card */
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        /* Đường viền nhẹ */
    }
</style>
