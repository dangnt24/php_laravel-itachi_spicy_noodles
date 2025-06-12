<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('BE/css/bootstrap.min.css') }}">
</head>
<body>
    <div style="background-color: #fff; position: absolute; top: 0; left: 0; right: 0; bottom: 0; z-index: 10000;">
        <section class="vh-100" style="background-image: url({{ asset('BE/img/banners/admin.png') }}); background-repeat: no-repeat; background-size: cover;">
            <div class="container py-3 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="background-color: #3d3d3d; border-radius: 50px; border-color: transparent;">
                        <div class="card-body p-5 text-center">
        
                            <h3 class="mb-4 text-white">Sign in</h3>
        
                            <form method="post" name="loginAdmin" id="loginAdmin" class="needs-validation" novalidate>
                                {{ csrf_field() }}
                                <div class="form-outline mb-4">
                                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" required value="<?php if(Session::get("usernameField")) {echo Session::get("usernameField"); Session::put('usernameField', null);} ?>" />
                                    <span id="msgUsername" style="display: block; color: red; text-align:left; margin-top: 8px;"></span>
                                    <div class="invalid-feedback text-start">Username cannot be blank.</div>
                                </div>
            
                                <div class="form-outline mb-4">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required />
                                    <span id="msgPassword" style="display: block; color: red; text-align:left; margin-top: 8px;"></span>
                                    <div class="invalid-feedback text-start">Password cannot be blank.</div>
                                </div>
                                
                                <span style="display: block; color: red; text-align:left; margin-bottom: 8px;">
                                    <?php 
                                        if (Session::get('errorMessage')) {
                                            echo "Tài khoản hoặc mật khẩu không chính xác!";
                                            Session::put('errorMessage', null);
                                        }    
                                    ?>
                                </span>
        
                                <button class="btn btn-primary btn-lg btn-block rounded-pill" id="login" name="login" type="submit" style="width: 80%; background-color: #50bdd0;" onclick=loginValidate()>Login</button>
                            </form>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </section>
    </div>
    
    <script src="{{ asset('BE/js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('BE/js/bootstrap.bundle.min.js') }}"></script>
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
    <style>
        #username, #password {
            border-radius: 50px;
        }
    </style>
</body>
</html>