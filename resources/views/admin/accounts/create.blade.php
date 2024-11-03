@extends("layouts.adminLayout")
@section("adminContent")

<div class="p-5">
	<form method="POST" enctype="multipart/form-data" id="formAccount" class="needs-validation" novalidate>
		{{ csrf_field() }}
		<div class="mb-5">
			<h2 class="text-center fw-bold">ADD ACCOUNT</h2>
		</div>
		<div>
			<div class="row">
				<div class="col-md-6 col-12">
					<div class="form-group">
						<label class="fw-bold">Username</label>
						<input type="text" class="form-control p-2" placeholder="Enter Username" name="username" id="username" required>
						<div class="invalid-feedback mt-2" id="msgUsername"></div>
					</div>
				</div>
				<div class="col-md-6 col-12">
					<div class="form-group">
						<label class="fw-bold">Fullname</label>
						<input type="text" class="form-control p-2" placeholder="Enter Fullname" name="fullname" id="fullname" required>
						<div class="invalid-feedback mt-2" id="msgFullname"></div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6 col-12">
					<div class="form-group">
						<label class="fw-bold">Password</label>
						<input type="password" class="form-control p-2" placeholder="Enter Password" name="password" id="password" required>
						<div class="invalid-feedback mt-2" id="msgPassword"></div>
					</div>
				</div>
				<div class="col-md-6 col-12">
					<div class="form-group">
						<label class="fw-bold">Confirm Password</label>
						<input type="password" onkeyup="confirmPassword" class="form-control p-2" placeholder="Enter Confirm Password" id="repassword" required>
						<div class="invalid-feedback mt-2" id="msgRepassword"></div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6 col-12">
					<div class="form-group">
						<label class="fw-bold">Birthday</label>
						<input type="date" class="form-control p-2" name="birthday" id="birthday" required>
						<div class="invalid-feedback mt-2" id="msgBirthday"></div>
					</div>	
				</div>
				<div class="col-md-6 col-12">
					<div class="form-group">
						<label class="fw-bold">Gender</label>
						<select name="gender" class="form-control text-dark">
							<option value="male" selected>Male</option>
							<option value="female">Female</option>
							<option value="other">Other</option>
						</select>
						<div class="invalid-feedback mt-2"></div>
					</div>		
				</div>
			</div>

			<div class="row">
				<div class="col-md-6 col-12">
					<div class="form-group">
						<label class="fw-bold">Email</label>
						<input type="email" class="form-control p-2" placeholder="Enter Email" name="email" id="email" required>
						<div class="invalid-feedback mt-2" id="msgEmail"></div>
					</div>	
				</div>
				<div class="col-md-6 col-12">
					<div class="form-group">
						<label class="fw-bold">Phone</label>
						<input type="text" class="form-control p-2" placeholder="Enter Phone" name="phone" id="phone" required>
						<div class="invalid-feedback mt-2" id="msgPhone"></div>
					</div>	
				</div>
			</div>

			<div class="row">
				<div class="col-md-6 col-12">
					<div class="form-group">
						<label class="fw-bold">Role</label>
						<select class="form-control text-dark" name="role_id">
							@foreach($roles as $role)
							<option value="{{ $role->role_id }}">{{ $role->name }}</option>
							@endforeach
						</select>
						<div class="invalid-feedback mt-2"></div>
					</div>	
				</div>
				<div class="col-md-6 col-12">
					<div class="form-group">
						<label class="fw-bold">Position</label>
						<input type="text" class="form-control p-2" placeholder="Enter Position" name="position">
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="fw-bold">Avatar</label>
				<input type="file" class="form-control" name="avatar">
				<img id="previewImage" src="{{ asset('BE/img/avatars/user.png') }}" alt="avatar" style="width: 50px; height: 50px; margin-top: 4px; display: none;">
			</div>		
				
			<div class="form-group">
				<label class="fw-bold">Address</label>
				<input type="text" class="form-control p-2" placeholder="Enter Address" name="address" id="address" required>
				<div class="invalid-feedback mt-2" id="msgAddress"></div>
			</div>
		</div>
		<div class="">
			<input type="submit" class="btn btn-success" value="Add" style="border-radius: 0;">
			<a role="button" class="btn btn-secondary" href="{{ URL::to('/admin/accounts') }}" style="border-radius: 0;">Cancel</a>
		</div>
	</form>
</div>

<script>
	var password = document.getElementById("password");
	var repassword = document.getElementById("repassword");
	var username = document.getElementById("username");
	var fullname = document.getElementById("fullname");
	var birthday = document.getElementById("birthday");
	var email = document.getElementById("email");
	var phone = document.getElementById("phone");
	var address = document.getElementById("address");

	var msgUsername = document.getElementById("msgUsername");
	var msgPassword = document.getElementById("msgPassword");
	var msgRepassword = document.getElementById("msgRepassword");
	var msgFullname = document.getElementById("msgFullname");
	var msgBirthday = document.getElementById("msgBirthday");
	var msgEmail = document.getElementById("msgEmail");
	var msgPhone = document.getElementById("msgPhone");
	var msgAddress = document.getElementById("msgAddress");

	msgUsername.innerText = username.validationMessage;
	msgPassword.innerText = password.validationMessage;
	msgRepassword.innerText = repassword.validationMessage;
	msgFullname.innerText = fullname.validationMessage;
	msgEmail.innerText = email.validationMessage;
	msgBirthday.innerText = birthday.validationMessage;
	msgPhone.innerText = phone.validationMessage;
	msgAddress.innerText = address.validationMessage;

	email.onkeyup = function () {
		msgEmail.innerText = email.validationMessage;
	}


	repassword.onkeyup = function (e) {
		if (!(password.value === repassword.value)) {
			repassword.setCustomValidity("Mật khẩu và xác nhận mật khẩu phải giống nhau.");
		} else {
			repassword.setCustomValidity("");
		}
		msgRepassword.innerText = repassword.validationMessage;
	}

	var avatar = document.querySelector("input[name=avatar]");
	var previewImage = document.querySelector("#previewImage");

	avatar.onchange = function (e) {
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
@endsection