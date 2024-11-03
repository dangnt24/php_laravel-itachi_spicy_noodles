@extends('layouts.homeLayout')
@section("homeContent")
    <section class="vh-100 bg-image login-layout login__container" style="background-image: url({{ asset("/FE/img/banners/login.jpg") }});">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3 login__mask">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card login__card">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-4 text-white login__heading">Đăng Nhập</h2>

                                <form id="loginForm" name="loginForm" method="post" class="needs-validation" novalidate>

                                    {{ csrf_field() }}

                                    <div class="form-outline mb-4">
                                        <input type="text" id="username" name="username" required class="form-control form-control-lg rounded-pill login__textfield" placeholder="Tên tài khoản" value="<?php if(Session::get("usernameField")) {echo Session::get("usernameField"); Session::put('usernameField', null);} ?>" />
                                        <span id="msgUsername" style="display: block; color: red; text-align:left; margin-top: 8px;"></span>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" id="password" name="password" required class="form-control form-control-lg rounded-pill login__textfield" placeholder="Mật khẩu" />
                                        <span id="msgPassword" style="display: block; color: red; text-align: left; margin-top: 8px;"></span>
                                    </div>

                                    <div id="msgValid" class="text-danger text-start my-3">
                                        <?php 
                                            if (Session::get('errorMessage')) {
                                                echo "Tài khoản hoặc mật khẩu không chính xác!";
                                                Session::put('errorMessage', null);
                                            }
                                        ?>
                                    </div>    

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-danger btn-block btn-lg rounded-pill login__btnsubmit" id="btnSubmit">Login</button>
                                    </div>

                                    <p class="text-center text-muted mt-5 mb-0">Bạn chưa có tài khoản? <a
                                            href="{{ URL::to("register") }}" class="fw-bold"><u>Đăng ký ngay</u></a></p>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection