<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Itachi Admin</title>
    <link rel="stylesheet" href="{{ asset('BE/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('BE/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('BE/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('BE/css/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('BE/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('BE/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('BE/css/toastr.min.css') }}">

    <link rel="icon" href="{{ asset('BE/img/logos/logo.png') }}" type="image/png" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="{{ URL::to('/admin') }}"><img src="{{ asset('BE/img/logos/logo1.png') }}" style="height: 52px" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="{{ URL::to('/admin') }}"><img src="{{ asset('BE/img/logos/logo.png') }}" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">

                <button class="navbar-toggler navbar-toggler align-self-center scroll-180" type="button" data-bs-toggle="minimize" style="box-shadow: none">
                    <span class="icon-menu"></span>
                </button>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown position-relative">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                            <img src="{{ asset('FE/img/avatars/'.Session::get('adminAccount')->avatar) }}" alt="profile" />
                            <span class="ms-2">{{ Session::get('adminAccount')->fullname }}</span>
                            <i class="fa-solid fa-chevron-down" style="font-size: 12px;"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown position-absolute"
                            aria-labelledby="profileDropdown" style="top: 112%; left: -40px; width: 200px;">
                            <a class="dropdown-item" href="{{ URL::to('/admin/profile') }}">
                                <i class="fa-regular fa-circle-user text-primary"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="{{ URL::to('/admin/changePassword') }}">
                                <i class="fa-solid fa-key text-primary"></i>
                                Change Password
                            </a>
                            <a onclick="return confirm('Do you want logout?')" class="dropdown-item" href="{{ URL::to('/admin/logout') }}">
                                <i class="ti-power-off text-primary"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas" style="box-shadow: none">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <div class="theme-setting-wrapper">
                <div id="settings-trigger"><i class="ti-settings"></i></div>
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close ti-close"></i>
                    <p class="settings-heading">SIDEBAR SKINS</p>
                    <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                        <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
                    </div>
                    <div class="sidebar-bg-options" id="sidebar-dark-theme">
                        <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
                    </div>
                    <p class="settings-heading mt-2">HEADER SKINS</p>
                    <div class="color-tiles mx-0 px-4">
                        <div class="tiles success"></div>
                        <div class="tiles warning"></div>
                        <div class="tiles danger"></div>
                        <div class="tiles info"></div>
                        <div class="tiles dark"></div>
                        <div class="tiles default"></div>
                    </div>
                </div>
            </div>
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item {{ request()->is('admin') || request()->is('admin/profile') ? 'active': '' }}">
                        <a class="nav-link" href="{{ URL::to('/admin') }}">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('admin/categories') || request()->is('admin/categories/create') || request()->is('admin/categories/update') ? 'active': '' }}">
                        <a class="nav-link" href="{{ URL::to('/admin/categories') }}" aria-expanded="false"
                            aria-controls="categories">
                            <i class="fa-solid fa-list menu-icon"></i>
                            <span class="menu-title">Categories</span>
                            <i class="menu-arrow"></i>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('admin/products') || request()->is('admin/products/create') || request()->is('admin/products/update') ? 'active': '' }}">
                        <a class="nav-link" href="{{ URL::to('/admin/products') }}" aria-expanded="false"
                            aria-controls="products">
                            <i class="fa-solid fa-box-open menu-icon"></i>
                            <span class="menu-title">Products</span>
                            <i class="menu-arrow"></i>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('admin/orders/general') || request()->is('admin/orders/update') || request()->is('admin/orders/confirmOrder') || request()->is('admin/orders/confirmCancelOrder') ? 'active': '' }}">
                        <a class="nav-link" data-bs-toggle="collapse" href="#Orders" aria-expanded="false" aria-controls="Orders">
                            <i class="fa-solid fa-scroll menu-icon"></i>
                            <span class="menu-title">Orders</span>
                            <i class="menu-arrow" style="{{ request()->is('admin/orders/general') || request()->is('admin/orders/update') || request()->is('admin/orders/confirmOrder') || request()->is('admin/orders/confirmCancelOrder') ? 'transform: rotate(-90deg);': '' }}"></i>
                        </a>
                        <div class="collapse bg-white" id="Orders">
                            <ul class="nav flex-column mx-2 my-0">
                                <li class="nav-item {{ request()->is('admin/orders/general') ? 'active': '' }}"><a href="{{ URL::to('/admin/orders/general') }}" class="nav-link"><i class="fa fa-solid fa-bars-progress me-2  menu-icon"></i><span class="menu-title">General</span></a></li>
                                <li class="nav-item {{ request()->is('admin/orders/confirmOrder') ? 'active': '' }}"><a href="{{ URL::to('/admin/orders/confirmOrder') }}" class="nav-link"><i class="fa-regular fa-circle-check me-2  menu-icon"></i><span class="menu-title">Confirm Order</span></a></li>
                                <li class="nav-item {{ request()->is('admin/orders/confirmCancelOrder') ? 'active': '' }}"><a href="{{ URL::to('/admin/orders/confirmCancelOrder') }}" class="nav-link"><i class="fa-solid fa-plane-slash me-2  menu-icon"></i><span class="menu-title">Cancellation Requests</span></a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item {{ request()->is('admin/accounts') || request()->is('admin/accounts/create') || request()->is('admin/accounts/update') ? 'active': '' }}">
                        <a class="nav-link" href="{{ URL::to('/admin/accounts') }}" aria-expanded="false"
                            aria-controls="accounts">
                            <i class="icon-head menu-icon"></i>
                            <span class="menu-title">Accounts</span>
                            <i class="menu-arrow"></i>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('admin/reviews') ? 'active': '' }}">
                        <a class="nav-link" href="{{ URL::to('/admin/reviews') }}" aria-expanded="false"
                            aria-controls="review">
                            <i class="fa-regular fa-star menu-icon"></i>
                            <span class="menu-title">Review</span>
                            <i class="menu-arrow"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">

                <div>
                    @yield("adminContent")
                </div>

                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.
                            Admin page from <a href="https://www.itachispicynoodles.com/" target="_blank">Itachi Spicy Noodles</a>. All rights reserved.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made
                            with <i class="fa-regular fa-heart text-danger ml-1"></i></span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->


    <script src="{{ asset('BE/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('BE/js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('BE/js/settings.js') }}"></script>
    <script src="{{ asset('BE/js/todolist.js') }}"></script>
    <script src="{{ asset('BE/js/toastr.min.js') }}"></script>
    <script src="{{ asset('BE/js/script.js') }}"></script>
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
