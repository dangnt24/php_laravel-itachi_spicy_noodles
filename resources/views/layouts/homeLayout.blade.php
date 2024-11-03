<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Itachi Spicy Noodles</title>
    <link rel="icon" href="{{ asset('FE/img/logos/logo.png') }}" type="image/x-icon"/>
    <link rel="stylesheet" href="{{ asset('FE/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('FE/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('FE/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('FE/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('FE/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('FE/css/toastr.min.css') }}">
</head>
<body class="d-flex flex-column justify-content-between" style="min-height: 100vh">
    <div id="navbar" class="container">
        <nav class="navbar navbar-expand-md navbar__head">
            <button type="button" class="navbar-toggler navbar__head--hover rounded-0" data-bs-toggle="collapse" data-bs-target="#navbarToggler" style="border: none; box-shadow: none;">
                <i class="fa-solid fa-bars" style="color: #fff; font-size: 20px; padding: 2px;"></i>
            </button>

            <div class="collapse navbar-collapse">
                <a href="tel: 0123456789" class="nav-link navbar-hotline"><i class="fa-solid fa-phone"></i> Hotline:0123456789</a>
            </div>

            <div class="d-flex navbar__head__nav align-items-center">
                <a href="{{ URL::to('/cart') }}" class="nav-link navbar__head--hover" style="padding-top: 7px; padding-bottom: 7px;"><i class="fa-solid fa-cart-shopping"></i> <span class="cart-responsive-hidden" style="font-size: 12px;">Giỏ hàng</span></a>

                @if (Session::get("username") && property_exists(Session::get("userAccount"), 'avatar'))
                <div class="dropdown position-relative">
                    <div class="btn-secondary dropdown-toggle header-right"
                     data-bs-toggle="dropdown">
                        <img src="{{ asset('FE/img/avatars/'.Session::get('userAccount')->avatar) }}" alt="avatar" class="" style="width: 27px; height: 27px; border: 1px solid #f5f5f5; border-radius: 50%; margin-right: 6px;" /> <?php echo Session::get('userAccount')->fullname; ?>
                    </div>
                    <ul class="dropdown-menu position-absolute" style="top: 106%; right: 10%;">
                        <li>
                            <a class="dropdown-item" href="{{ URL::to('/profile') }}">
                                <i class="fa-solid fa-user me-1"></i> Tài khoản
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="{{ URL::to('/myOrders') }}">
                                <i class="fa-regular fa-note-sticky me-1"></i> Đơn mua
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="{{ URL::to('/changePassword') }}">
                                <i class="fa-solid fa-gears me-1"></i> Đổi mật khẩu
                            </a>
                        </li>

                        <li>
                            <a onclick="return confirm('Do you want to log out account {{ Session::get('username') }}?')" class="dropdown-item" href="{{ URL::to("/logout") }}">
                                <i class="fa-solid fa-right-from-bracket me-1"></i> Đăng xuất
                            </a>
                        </li>
                    </ul>
                </div>
                @else
                <a href="{{ URL::to('/login') }}" class="nav-link navbar-toggler navbar__head--hover rounded-0" style="box-shadow: none; padding-top: 7px; padding-bottom: 7px;">
                    <i class="fa-solid fa-user"></i>
                </a>

                <div class="collapse navbar-collapse" id="navbarTogglerAccount">
                    <ul class="navbar-nav h-100 d-flex align-items-center">
                        <li class="nav-item h-100 d-flex align-items-center">
                            <a href="{{ URL::to('/login') }}" class="nav-link" style="padding-top: 7px; padding-bottom: 7px;"><i class="fa-solid fa-right-to-bracket"></i> Đăng nhập</a>
                        </li>
                        <li class="nav-item h-100 d-flex align-items-center">
                            <a href="{{ URL::to('/register') }}" class="nav-link" style="padding-top: 7px; padding-bottom: 7px;"><i class="fa-solid fa-user-plus"></i> Đăng ký</a>
                        </li>
                    </ul>
                </div>
                @endif
            </div>
        </nav>

        <nav class="navbar navbar__body">
            <div class="row">
                <div class="col-md-4">
                    <a class="navbar-brand" href="{{ URL::to('/') }}">
                        <img src="{{ asset('FE/img/logos/logo1.png') }}" class="img-fluid img-brand">
                    </a>
                </div>
                <div class="col-md-8 search-responsive-lg">
                    <form class="d-flex search w-100" action="{{ URL::to('/search') }}" method="get">
                        <input type="form-control" name="search" class="w-100" id="search" placeholder="Bạn đang muốn tìm món gì?" required>
                        <button type="submit" class="btn">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        @if(!request()->is("cart") && !request()->is("details") && !request()->is("payment") && !request()->is("changePassword") && !request()->is("profile") && !request()->is("editProfile")  && !request()->is("register"))
        <nav class="navbar navbar-expand-md navbar__nav">
            <div class="collapse navbar-collapse" id="navbarToggler">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item {{ (request()->is('/') || request()->is('details') || request()->is('search')) || request()->is('checkOrder') || request()->is('myOrders') || request()->is('review') || request()->is('myOrderDetails')? 'active': '' }}">
                        <a href="{{ URL::to('/') }}" class="nav-link">Trang chủ</a>
                    </li>

                    <li class="nav-item {{ request()->is('products') ? 'active': '' }}">
                        <a href="{{ URL::to('/products') }}" class="nav-link">Sản phẩm</a>
                    </li>

                    <li class="nav-item {{ request()->is('about') ? 'active': '' }}">
                        <a href="{{ URL::to('/about') }}" class="nav-link">Giới Thiệu</a>
                    </li>

                    <li class="nav-item {{ request()->is('contact') ? 'active': '' }}">
                        <a href="{{ URL::to('/contact') }}" class="nav-link">Liên hệ</a>
                    </li>

                    <li class="nav-item search-responsive-sm">
                        <div class="d-flex search">
                            <form class="w-100" action="{{ URL::to('/search') }}" method="get">
                                <input type="form-control" name="search" id="search" placeholder="Bạn đang muốn tìm món gì?" required>
                                <button type="submit" class="btn">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        @endif
    </div>

    <div id="body" class="container mb-5">
        @yield('homeContent')
    </div>

    <foooter id="footer" class="mt-5 {{ request()->is('cart') || request()->is('changePassword')?'fixed-bottom': '' }}">
        <!-- Copyright -->
        <div class="footer-copyright text-center py-3" style="background-color: #d0011be6; color: #fff;">© 2023 Copyright:
            <a href="#" style="color: #fff; text-decoration: none;"> Itachi Spicy Noodles</a>
        </div>
        <!-- Copyright -->
    </foooter>

    <script src="{{ asset('FE/js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('FE/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('FE/js/owl.carousel.js') }}"></script>
    <script src="{{ asset('FE/js/toastr.min.js') }}"></script>
    <script src="{{ asset('FE/js/script.js') }}"></script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
    </script>
	<?php
        if(Session::get("message")) {
            echo "<script>toastr.".Session::get("msgType")."('".Session::get("message")."')</script>";
            Session::put("message", null);
            Session::put("msgType", null);
        }
    ?>
</body>
</html>
