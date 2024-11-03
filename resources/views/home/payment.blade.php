@extends('layouts.homeLayout')
@section("homeContent")
    <div class="container mt-4">
        <form class="needs-validation" name="frmthanhtoan" method="post" action="{{ URL::to('/payment') }}">
            {{ csrf_field() }}
            <input type="hidden" name="username" value="{{ Session::get('username') }}">
            <input type="hidden" name="total_pay" value="{{ $total_pay }}">

            <div class="pt-3 pb-5 text-center">
                <i class="fa fa-credit-card fa-4x" aria-hidden="true"></i>
                <h2>Thanh toán</h2>
                <p class="lead">Vui lòng kiểm tra thông tin Khách hàng, thông tin Giỏ hàng trước khi Đặt hàng.</p>
            </div>

            <div class="row">
                <div class="col-md-8 col-12">
                    <h4 class="mb-3">Thông tin khách hàng</h4>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="">Họ tên</label>
                            <input type="text" class="form-control" name="fullname" value="{{ $user->fullname }}" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Điện thoại</label>
                            <input type="text" class="form-control" name="phone" value="{{ $user->phone }}" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Địa chỉ</label>
                            <input type="text" class="form-control" name="address" value="{{ $user->address }}" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Ghi chú</label>
                            <textarea name="order_note" class="form-control"></textarea>
                        </div>
                    </div>

                    <h4 class="my-3">Hình thức thanh toán</h4>

                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input name="deliveryMethod" type="radio" class="custom-control-input" required=""
                                value="Delivery" checked>
                            <label class="custom-control-label" for="httt-1">Thanh toán khi nhận</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input name="deliveryMethod" type="radio" class="custom-control-input" required=""
                                value="Take Away">
                            <label class="custom-control-label" for="httt-3">Nhận mỳ trực tiếp tại quán</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Giỏ hàng</span>
                        <span class="badge badge-secondary badge-pill">2</span>
                    </h4>
                    <ul class="list-group mb-3">

                        @foreach(Session::get("cart") as $key => $item)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">{{ $item['title'] }}</h6>
                                <?php
                                    $note = array();
                                    if($item['level']) array_push($note, $item['level']."đ");
                                    if($item['isFresh']) array_push($note, "Để sống");
                                    if($item['note']) array_push($note, $item['note']);
                                ?>
                                <div class="text-wrap text-secondary">{{ $item['level'] || $item['isFresh'] || $item['note']? "Ghi chú: ": "" }}{{  $note? join(", ", $note): "" }}</div>
                                <small class="text-muted">{{ $item['price'] }}.000đ x {{ $item['quantity'] }}</small>
                            </div>
                            <span class="text-muted">{{ $item['total_money'] }}.000đ</span>
                        </li>
                        @endforeach

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Tổng thành tiền</span>
                            <strong>{{ $total_pay }}.000đ</strong>
                        </li>
                    </ul>
                    <hr class="mb-4">
                    <div class="text-end">
                        <a href="{{ URL::to('/cart') }}" class="btn btn-secondary me-2" role="button" name="btnDatHang">Trở lại</a>
                        <button class="btn btn-danger" type="submit" name="btnDatHang">Đặt hàng</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection
