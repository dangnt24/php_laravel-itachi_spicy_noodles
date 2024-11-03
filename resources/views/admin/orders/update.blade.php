@extends('layouts.adminLayout')
@section('adminContent')
    <div class="container py-5">
        <h2 class="text-center text-uppercase mb-4">Cập nhật đơn hàng</h2>

        <!-- Hiển thị thông báo thành công -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-6 col-12">
                <form action="{{ url('/admin/orders/update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="o_id" value="{{ $orderItem->o_id }}">
                    <div class="form-group">
                        <label for="fullname">Họ và tên</label>
                        <input type="text" name="fullname" id="fullname" class="form-control" value="{{ $orderItem->fullname }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="{{ $orderItem->phone }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input type="text" name="address" id="address" class="form-control" value="{{ $orderItem->address }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="delivery_method">Phương thức giao hàng</label>
                        <select name="delivery_method" id="delivery_method" class="form-control text-dark">
                            <option value="Delivery" {{ $orderItem->delivery_method == 'Delivery' ? 'selected' : '' }}>Thanh toán khi nhận
                            </option>
                            <option value="Take Away" {{ $orderItem->delivery_method == 'Take Away' ? 'selected' : '' }}>Nhận mỳ trực tiếp tại quán
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="total_pay">Tổng thanh toán</label>
                        <input type="number" name="total_pay" id="total_pay" class="form-control" value="{{ $orderItem->total_pay }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="order_note">Ghi chú đơn hàng</label>
                        <textarea name="order_note" id="order_note" class="form-control">{{ $orderItem->order_note }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="status">Trạng thái</label>
                        <select name="status" id="status" class="form-control text-dark">
                            <option value="Initialized" {{ $orderItem->status == 'Initialized' ? 'selected' : '' }}>Đơn Hàng Đã Đặt
                            </option>
                            <option value="Confirmed" {{ $orderItem->status == 'Confirmed' ? 'selected' : '' }}>Đơn Hàng Đã Xác Nhận Thành Công
                            </option>
                            <option value="To Delivery" {{ $orderItem->status == 'To Delivery' ? 'selected' : '' }}>Chờ Lấy Hàng
                            </option>
                            <option value="To Receive" {{ $orderItem->status == 'To Receive' ? 'selected' : '' }}>Đang Giao
                            </option>
                            <option value="To Review" {{ $orderItem->status == 'To Review' ? 'selected' : '' }}>Chờ Đánh Giá
                            </option>
                            <option value="Done" {{ $orderItem->status == 'Done' ? 'selected' : '' }}>Hoàn Thành
                            </option>
                            <!-- Thêm các tùy chọn khác nếu cần -->
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </form>
            </div>
            <div class="col-md-6 col-12">
                <div class="px-5 py-3">
                    <ul class="list-group my-3">
                        @foreach ($orderDetails as $od)
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div class="d-flex">
                                    <div class="me-3"><img src="{{ asset('FE/img/products/' . $od->pro_image) }}" alt=""
                                            style="width: 64px; hieght: 64px;"></div>
                                    <div>
                                        <h6 class="my-0">{{ $od->pro_name }}</h6>
                                        @php
                                            $note = [];
                                            if ($od->level) {
                                                array_push($note, $od->level . 'đ');
                                            }
                                            if ($od->isFresh) {
                                                array_push($note, 'Để sống');
                                            }
                                            if ($od->note) {
                                                array_push($note, $od->note);
                                            }
                                        @endphp
                                        <div class="text-wrap text-secondary">
                                            {{ $od->level || $od->isFresh || $od->note ? 'Ghi chú: ' : '' }}{{ $note ? join(', ', $note) : '' }}
                                        </div>
                                        <small class="text-muted">{{ $od->price }}.000đ x {{ $od->quantity }}</small>
                                    </div>
                                </div>
                                <strong>{{ $od->price * $od->quantity }}.000đ</strong>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
