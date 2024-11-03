@extends('layouts.homeLayout')
@section("homeContent")
    {{-- <section class="bg-image register-layout login__container" style="background-image: url({{ asset('/FE/img/banners/login.jpg') }};">
        <div class="mask d-flex align-items-center gradient-custom-3 login__mask"> --}}
            {{-- <div class="">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6 mb-3">
                        <div class="card login__card" style="border-radius: 15px;">
                            <div class="card-body p-3"> --}}
                                
                                <h3 class="text-uppercase text-center my-3">Đăng ký tài khoản</h2>
                                
                                <form method="POST" enctype="multipart/form-data" id="formAccount" class="needs-validation bg-muted" novalidate>
                                    <div class="row">
                                    {{ csrf_field() }}
                                    <div class="col-6">
                                        
                                    <div class="form-group mt-3">
                                        <label for="" class="fw-bold">Tên tài khoản</label>
                                        <input type="text" class="form-control" name="username" id="username" required placeholder="Tên tài khoản">
                                        <div class="invalid-feedback mt-2" id="msgUsername"></div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="" class="fw-bold">Mật khẩu</label>
                                        <input type="password" class="form-control" name="password" id="password" required placeholder="Mật khẩu">
                                        <div class="invalid-feedback mt-2" id="msgPassword"></div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="" class="fw-bold">Xác nhận mật khẩu</label>
                                        <input type="password" onkeyup="confirmPassword" class="form-control" id="repassword" required placeholder="Xác nhận mật khẩu">
                                        <div class="invalid-feedback mt-2" id="msgRepassword"></div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="" class="fw-bold">Họ tên</label>
                                        <input type="text" class="form-control" name="fullname" id="fullname" required placeholder="Họ tên">
                                        <div class="invalid-feedback mt-2" id="msgFullname"></div>
                                    </div>		
                                    <div class="form-group mt-3">
                                        <label for="" class="fw-bold">Ngày sinh</label>
                                        <input type="date" class="form-control" name="birthday" id="birthday" required placeholder="Ngày sinh">
                                        <div class="invalid-feedback mt-2" id="msgBirthday"></div>
                                    </div>		
                                    <div class="form-group mt-3">
                                        <label for="" class="fw-bold">Giới tính</label>
                                        <select name="gender" class="form-control text-dark" placeholder="Giới tính">
                                            <option value="male" selected>Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <div class="invalid-feedback mt-2"></div>
                                    </div>	
                                    
                                </div>


                                <div class="col-6">
                                    <div class="form-group mt-3">
                                        <label for="" class="fw-bold">Ảnh đại diện</label>
                                        <input type="file" class="form-control" name="avatar" placeholder="Ảnh đại diện">
                                        <img id="previewImage" src="{{ asset('FE/img/avatars/user.png') }}" alt="avatar" style="width: 50px; height: 50px; margin-top: 4px;">
                                    </div>		
                                    <div class="form-group mt-3">
                                        <label for="" class="fw-bold">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" required placeholder="Email">
                                        <div class="invalid-feedback mt-2" id="msgEmail"></div>
                                    </div>		
                                    <div class="form-group mt-3">
                                        <label for="" class="fw-bold">Số điện thoại</label>
                                        <input type="text" class="form-control" name="phone" id="phone" required placeholder="Số điện thoại">
                                        <div class="invalid-feedback mt-2" id="msgPhone"></div>
                                    </div>		
                                    <div class="form-group mt-3">
                                        <label for="" class="fw-bold">Địa chỉ</label>
                                        <input type="text" class="form-control" name="address" id="address" required placeholder="Địa chỉ">
                                        <div class="invalid-feedback mt-2" id="msgAddress"></div>
                                    </div>

                                </div>

                                    <div class="form-check text-center my-5 mb-3">
                                        <input type="checkbox" class="form-check-input me-2" style="float: none;" value="" id="agree" required>
                                        <label class="form-check-label" for="agree" style="color: #333;">
                                            Tôi đồng ý với tất cả <a href="#" class="text-body"><u style="color: red;">Điều khoản và dịch vụ</u></a>
                                        </label>
                                        <div class="invalid-feedback mt-2" id="msgAgree"></div>
                                    </div>

                                    <div class="d-flex justify-content-center ">
                                        <button type="submit" class="btn btn-danger btn-block btn-lg">Đăng kí ngay</button>
                                    </div>

                                    <p class="text-center text-muted my-5">Bạn đã có tài khoản? <a href="{{ URL::to('/login') }}" class="fw-bold text-body"><u>Đăng nhập ngay</u></a></p>
                                </div>
                                </form>
                            {{-- </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        {{-- </div> --}}
        {{-- </section> --}}
        <script>
            var password = document.getElementById("password");
		var repassword = document.getElementById("repassword");
		var username = document.getElementById("username");
		var fullname = document.getElementById("fullname");
		var birthday = document.getElementById("birthday");
		var email = document.getElementById("email");
		var phone = document.getElementById("phone");
		var address = document.getElementById("address");
		var agree = document.getElementById("agree");

		var msgUsername = document.getElementById("msgUsername");
		var msgPassword = document.getElementById("msgPassword");
		var msgRepassword = document.getElementById("msgRepassword");
		var msgFullname = document.getElementById("msgFullname");
		var msgBirthday = document.getElementById("msgBirthday");
		var msgEmail = document.getElementById("msgEmail");
		var msgPhone = document.getElementById("msgPhone");
		var msgAddress = document.getElementById("msgAddress");
		var msgAgree = document.getElementById("msgAgree");

		msgUsername.innerText = username.validationMessage;
		msgPassword.innerText = password.validationMessage;
		msgRepassword.innerText = repassword.validationMessage;
		msgFullname.innerText = fullname.validationMessage;
		msgEmail.innerText = email.validationMessage;
		msgBirthday.innerText = birthday.validationMessage;
		msgPhone.innerText = phone.validationMessage;
		msgAddress.innerText = address.validationMessage;
		msgAgree.innerText = agree.validationMessage;
		
		email.onkeyup = function() {
			msgEmail.innerText = email.validationMessage; 
		}
		
		
		repassword.onkeyup = function (e) {
			if (repassword.value == "") {
                repassword.setCustomValidity("Vui lòng điền vào trường này.");
            } else if (!(password.value === repassword.value)) {
				repassword.setCustomValidity("Mật khẩu và xác nhận mật khẩu phải giống nhau.");
			} else {
                repassword.setCustomValidity("");
            }
            msgRepassword.innerText = repassword.validationMessage;
		}

		var avatar = document.querySelector("input[name=avatar]");
        var previewImage = document.querySelector("#previewImage");

        avatar.onchange = function(e) {
            if (event.target.files.length > 0) {
				previewImage.src = URL.createObjectURL(
				e.target.files[0],
				);

				previewImage.style.display = "block";
			} else {
				previewImage.style.display = "none";
			}
        }
        </script>
    </section>
@endsection