@extends("layouts.adminLayout")
@section("adminContent")
	<div style="margin-bottom: calc(100vh - 450px);">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
					<div class="modal-header">						
						<h4 class="modal-title">Update Account</h4>
						<a role="button" href="{{ URL::to("/admin/accounts") }}" class="close" aria-hidden="true">&times;</a>
					</div>
					<div class="modal-body">
						<input type="hidden" name="username" value="{{ $account->username }}">
						<div class="form-group">
							<label>Fullname</label>
							<input type="text" class="form-control" name="fullname" required value="{{ $account->fullname }}">
						</div>		
						<div class="form-group">
							<label>Gender</label>
							<select name="gender" class="form-control text-dark">
								<option value="male" {{ $account->gender == "male"? "selected": "" }}>Male</option>
								<option value="female" {{ $account->gender == "female"? "selected": "" }}>Female</option>
								<option value="other" {{ $account->gender == "other"? "selected": "" }}>Other</option>
							</select>
						</div>		
						<div class="form-group">
							<label>Birthday</label>
							<input type="date" class="form-control" name="birthday" required value="{{ date("Y-m-d", strtotime($account->birthday) ) }}">
						</div>		
						<div class="form-group">
							<label>Avatar</label>
							<input type="file" class="form-control" name="avatar">
							<img id="previewImage" src="{{ asset("FE/img/avatars/$account->avatar") }}" alt="avatar" style="width: 50px; height: 50px; margin-top: 4px;">
						</div>		
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" name="email" required value="{{ $account->email }}">
						</div>		
						<div class="form-group">
							<label>Phone</label>
							<input type="text" class="form-control" name="phone" required value="{{ $account->phone }}">
						</div>		
						<div class="form-group">
							<label>Address</label>
							<input type="text" class="form-control" name="address" required value="{{ $account->address }}">
						</div>
						<div class="form-group">
							<label>Position</label>
							<input type="text" class="form-control" name="position" value="{{ $account->position }}">
						</div>
					</div>
					<div class="modal-footer">
						<a role="button" class="btn btn-default" href="{{ URL::to("/admin/accounts") }}">Cancel</a>
						<input type="submit" class="btn btn-success" value="Save">
					</div>
				</form>
			</div>
		</div>
	</div>
	
    <script>
        var avatar = document.querySelector("input[name=avatar]");
        var previewImage = document.querySelector("#previewImage");

        avatar.onchange = function(e) {
            if (event.target.files.length > 0) {
				previewImage.src = URL.createObjectURL(
				e.target.files[0],
				);
			} 
        }
    </script>
@endsection