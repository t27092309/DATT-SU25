<header id="masthead" class="site-header py-2 shadow-sm bg-white sticky-top">
    <div class="container-fluid">
        <div class="row align-items-center">
            <!-- Logo -->
            <div class="col-6 col-md-3 d-flex align-items-center">
                <a href="{{ route('home') }}" class="d-flex align-items-center text-decoration-none">
                    <img src="{{ asset('assets/images/3xshop-light.png') }}" alt="GIÀY XSHOP" style="max-width:88%;" class="me-2">
                    <span class="fw-bold text-dark" style="font-size:12px;">GIÀY XSHOP</span>

                </a>
            </div>


            <!-- Menu -->
            <nav class="col-md-6 d-none d-md-block">
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link">
                            <i class="bi bi-house-door"></i> Trang chủ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('categories.index') }}" class="nav-link">
                            <i class="bi bi-list-ul"></i> Danh mục
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cart.index') }}" class="nav-link">
                            <i class="bi bi-cart"></i> Giỏ hàng
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('checkout.index') }}" class="nav-link">
                            <i class="bi bi-credit-card"></i> Thanh toán
                        </a>
                    </li>

                    @guest
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">
                            <i class="bi bi-box-arrow-in-right"></i> Đăng nhập
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link">
                            <i class="bi bi-person-plus"></i> Đăng ký
                        </a>
                    </li>
                    @else
                    <li class="nav-item">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link">
                                <i class="bi bi-box-arrow-right"></i> Đăng xuất
                            </button>
                        </form>
                    </li>
                    @endguest
                </ul>
            </nav>

            <!-- Icons -->
            <div class="col-6 col-md-3 text-end">
                <a href="#" class="text-dark me-3" data-bs-toggle="modal" data-bs-target="#search-modal">
                    <i class="bi bi-search"></i>
                </a>
                <a href="{{ route('cart.index') }}" class="text-dark">
                    <i class="bi bi-cart"></i>
                </a>
            </div>
        </div>
    </div>
</header>
<style>
    header.site-header {
        z-index: 999;
    }

    header .nav-link {
        color: #333;
    }

    header .nav-link:hover {
        color: #0d6efd;
    }

    header .nav-link {
        padding-left: 0.5rem;
        padding-right: 0.5rem;
        font-size: 0.95rem;
        /* giảm nhẹ font-size nếu cần */
    }
    header .nav-link {
    padding: 0.4rem 0.75rem;       /* Padding nút */
    border-radius: 50px;           /* Bo tròn pill */
    transition: all 0.3s ease;     /* Hiệu ứng mượt */
}

header .nav-link:hover {
    background-color: #0d6efd;     /* Màu nền khi hover */
    color: #fff !important;        /* Màu chữ khi hover */
}
</style>
