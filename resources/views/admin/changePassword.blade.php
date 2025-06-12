@extends('layouts.adminLayout');
@section('adminContent')
    <div class="container mt-3" style="max-width: 500px;">
        <div class="row">
            <div class="col-12 text-center">
                <h2>Change Password</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-offset-3">
                <p class="text-center mb-3">Use the form below to change your password. Your password cannot be the same as your
                    username.</p>

                <form method="post" class="needs-validation" novalidate>
                    {{ csrf_field() }}
                    <div class="form-group mb-3">
                        <label for=""></label>
                        <input type="password" class="form-control" name="oldPassword" id="oldPassword" required placeholder="Old Password">
                        <div class="invalid-feedback mt-2" id="msgOldPassword"></div><div id="msgValid" class="text-danger text-start my-2">
                            <?php
                                echo Session::get('messageInvalidOldPassword')? Session::get('messageInvalidOldPassword'): "";
                                Session::put('messageInvalidOldPassword', null);
                            ?>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for=""></label>
                        <input type="password" class="form-control" name="newPassword" id="newPassword" required placeholder="New Password">
                        <div class="invalid-feedback mt-2" id="msgNewPassword"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for=""></label>
                        <input type="password" class="form-control" name="repassword" id="repassword" required placeholder="Confirm Password">
                        <div class="invalid-feedback mt-2" id="msgRepassword"></div>
                    </div>
                    <div class="form-group mb-3 text-end">
                        <a href="{{ URL::to('/admin') }}" class="btn btn-secondary btn-md me-2" role="button" name="btnDatHang">Trở lại</a>
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
                repassword.setCustomValidity("Please fill in this field.");
            } else if (!(newPassword.value === repassword.value)) {
                repassword.setCustomValidity("New password and confirm password must be the same.");
            } else {
                repassword.setCustomValidity("");
            }
            msgRepassword.innerText = repassword.validationMessage;
        }
    </script>
    <style>
        footer.footer {
            position: fixed;
            bottom: 0;
            width: 90%; 
        }
    </style>
@endsection
