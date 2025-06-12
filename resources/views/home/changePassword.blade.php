@extends('layouts.homeLayout')
@section('homeContent')
    <div class="row mt-3">
        <div class="col-12 topnav-detail">
            <a href="{{ URL::to('/') }}" class="text-decoration-none topnav-detail__item">Trang chủ</a> > Đổi mật khẩu
        </div>
    </div>
    <div class="d-flex flex-column align-items-center mt-3">
        <div class="card shadow-2-strong changePassword-responsive">
            <div class="card-body px-5">
                <h3 class="mb-3">Đổi mật khẩu</h3>
                
                <form method="post" class="needs-validation" novalidate>
                    {{ csrf_field() }}
                    <div class="form-group mb-3">
                        <label for="kh_ten">Mật khẩu cũ</label>
                        <input type="password" class="form-control" name="oldPassword" id="oldPassword" required>
                        <div class="invalid-feedback mt-2" id="msgOldPassword"></div><div id="msgValid" class="text-danger text-start my-2">
                            <?php 
                                echo Session::get('messageInvalidOldPassword')? Session::get('messageInvalidOldPassword'): "";
                                Session::put('messageInvalidOldPassword', null);
                            ?>
                        </div>    
                    </div>
                    <div class="form-group mb-3">
                        <label for="kh_ten">Mật khẩu mới</label>
                        <input type="password" class="form-control" name="newPassword" id="newPassword" required>
                        <div class="invalid-feedback mt-2" id="msgNewPassword"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="kh_ten">Xác nhận mật khẩu</label>
                        <input type="password" class="form-control" name="repassword" id="repassword" required>
                        <div class="invalid-feedback mt-2" id="msgRepassword"></div>
                    </div>
                    <div class="form-group mb-3 text-end">
                        <a href="{{ URL::to('/') }}" class="btn btn-secondary btn-md me-2" role="button" name="btnDatHang">Trở lại</a>
                        <button class="btn btn-primary btn-md" type="submit" name="btnDatHang">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        var oldPassword = document.getElementById("oldPassword");
        var newPassword = document.getElementById("newPassword");
        var repassword = document.getElementById("repassword");

        var msgOldPassword = document.getElementById("msgOldPassword");
        var msgNewPassword = document.getElementById("msgNewPassword");
        var msgRepassword = document.getElementById("msgRepassword");

        msgOldPassword.innerText = oldPassword.validationMessage;
        msgNewPassword.innerText = newPassword.validationMessage;
        msgRepassword.innerText = repassword.validationMessage;  
        
        repassword.onkeyup = function (e) {
            if (repassword.value == "") {
                repassword.setCustomValidity("Vui lòng điền vào trường này.");
            } else if (!(newPassword.value === repassword.value)) {
                repassword.setCustomValidity("Mật khẩu mới và xác nhận mật khẩu phải giống nhau.");
            } else {
                repassword.setCustomValidity("");
            }
            msgRepassword.innerText = repassword.validationMessage;
        }
    </script>
    <style>
        #body {
            margin: auto !important;
        }
    </style>
@endsection
