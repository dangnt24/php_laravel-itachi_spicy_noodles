@extends('layouts.homeLayout')
@section('homeContent')
    <div class="row mt-3 mb-2">
        <div class="col-12 topnav-detail">
            <a href="{{ URL::to('/') }}" class="text-decoration-none topnav-detail__item">Trang chủ</a> > Thông tin tài khoản
        </div>
    </div>
    <section class="vh-100" style="background-color: #f4f5f7;">
        <div class="container pt-5 pb-5 h-100">
            <div class="row d-flex justify-content-center h-100">
                <div class="col col-lg-6 mb-4 mb-lg-0">
                    <div class="card mb-3" style="border-radius: .5rem;">
                        <div class="row g-0">
                            <div class="col-md-4 gradient-custom text-center"
                                style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                <img src="{{ asset('FE/img/avatars/'.$account->avatar) }}"
                                    alt="Avatar" class="img-fluid mt-5 mb-3" style="width: 80px; height: 80px; border-radius: 50%;" />
                                <h5>{{ $account->fullname }}</h5>
                                {{-- <p class="text-muted">{{ $account->position }}</p> --}}
                                <a href="{{ URL::to('/editProfile') }}" class=""><i class="far fa-edit mb-5"></i></a>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-4">
                                    <h6>Thông tin tài khoản</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6>Ngày sinh</h6>
                                            <p class="text-muted">{{ date("d-m-Y", strtotime($account->birthday)) }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Giới tính</h6>
                                            <p class="text-muted">{{ $account->gender }}</p>
                                        </div>
                                    </div>
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6>Email</h6>
                                            <p class="text-muted">{{ $account->email }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Số diện thoại</h6>
                                            <p class="text-muted">{{ $account->phone }}</p>
                                        </div>
                                    </div>
                                    <h6>Địa chỉ</h6>
                                    <hr class="mt-0 mb-2">
                                    <p class="text-muted">{{ $account->address }}</p>
                                    {{-- <div class="d-flex justify-content-start">
                                        <a href="#!"><i class="fab fa-facebook-f fa-lg me-3"></i></a>
                                        <a href="#!"><i class="fab fa-twitter fa-lg me-3"></i></a>
                                        <a href="#!"><i class="fab fa-instagram fa-lg"></i></a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
