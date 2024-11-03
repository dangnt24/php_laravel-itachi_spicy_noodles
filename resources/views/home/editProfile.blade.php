@extends("layouts.homeLayout")
@section("homeContent")
    <div class="row mt-3">
        <div class="col-12 topnav-detail">
            <a href="{{ URL::to('/') }}" class="text-decoration-none topnav-detail__item">Trang chủ</a> > Chỉnh sửa thông tin
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div style="flex: 0 1 750px;">
            <form method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="my-3 text">
                    <h4 class="modal-title text-secondary text-center">Chỉnh sửa thông tin tài khoản</h4>
                    {{-- <a role="button" href="{{ URL::to('/admin/accounts') }}" class="close" aria-hidden="true">&times;</a> --}}
                </div>
                <div class="mt-3">
                    <input type="hidden" name="username" value="{{ $account->username }}">
                    <div class="form-group mb-2">
                        <label>Fullname</label>
                        <input type="text" class="form-control" name="fullname" required value="{{ $account->fullname }}">
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group mb-2">
                                <label>Gender</label>
                                <select name="gender" class="form-control text-dark">
                                    <option value="male" {{ $account->gender == "male"? "selected": "" }}>Male</option>
                                    <option value="female" {{ $account->gender == "female"? "selected": "" }}>Female</option>
                                    <option value="other" {{ $account->gender == "other"? "selected": "" }}>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group mb-2">
                                <label>Birthday</label>
                                <input type="date" class="form-control" name="birthday" required value="{{ date("Y-m-d", strtotime($account->birthday) ) }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" required value="{{ $account->email }}">
                    </div>
                    <div class="form-group mb-2">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone" required value="{{ $account->phone }}">
                    </div>
                    <div class="form-group mb-2">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address" required value="{{ $account->address }}">
                    </div>
                    <div class="form-group mb-2">
                        <label>Avatar</label>
                        <input type="file" class="form-control" name="avatar">
                        <img id="previewImage" src="{{ asset('FE/img/avatars/'.$account->avatar) }}" alt="avatar" style="width: 50px; height: 50px; margin-top: 4px;">
                    </div>
                    {{-- <div class="form-group mb-2">
                        <label>Position</label>
                        <input type="text" class="form-control" name="position" value="{{ $account->position }}">
                    </div> --}}
                </div>
                <div class="my-5 text-end">
                    <a role="button" class="btn btn-default" href="{{ URL::to('/profile') }}">Cancel</a>
                    <input type="submit" class="btn btn-danger" value="Save">
                </div>
            </form>
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
