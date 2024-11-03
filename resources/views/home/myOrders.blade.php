@extends('layouts.homeLayout')
@section('homeContent')
    <div class="container px-5 py-3" id="myOrderDetails">
        <h2 class="text-center text-uppercase mb-4">đơn hàng của tôi</h2>
        @foreach ($orders as $order)
            <div class="mt-3" style="border: 1px solid red">
                <div class="d-flex justify-content-between p-3 pb-0">
                    <div><a href="/myOrderDetails?id={{ $order[0]->o_id }}" class="fw-bold">Mã Đơn Hàng:
                            #{{ $order[0]->o_id }}</a></div>
                    @php
                        $status = [
                            'Initialized' => 'Đơn Hàng Đã Đặt',
                            'Confirmed' => 'Đơn Hàng Đã Xác Nhận Thành Công',
                            'To Delivery' => 'Chờ Lấy Hàng',
                            'To Receive' => 'Đang Giao',
                            'To Review' => 'Chờ Đánh Giá',
                            'Done' => 'Hoàn Thành',
                            'To Cancel' => 'Đang Xác Nhận Hủy',
                            'Canceled' => 'Đã Hủy'
                        ];
                    @endphp
                    <div class="{{ $order[0]->status == 'Canceled' ? 'text-danger' : 'text-success' }} text-uppercase">
                        {{ $status[$order[0]->status] }}</div>
                </div>
                <hr class="bg-danger mb-0">
                <ul class="list-group">
                    @foreach ($order as $od)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div class="d-flex">
                                <div class="me-3"><img src="{{ asset('FE/img/products/' . $od->pro_image) }}"
                                        alt="" style="width: 64px; hieght: 64px;"></div>
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
                <hr class="bg-danger mt-0">
                <div class="d-flex justify-content-between p-3">
                    <div class="text-muted" style="max-width: 50%"><span class="fw-bold text-dark">
                            @if ($od->order_note)
                                Lưu ý:
                        </span>{{ $od->order_note }}
        @endif
    </div>
    <div>
        <div class="text-end mb-3">
            <span class="me-2">Thành tiền: </span>
            <strong class="fs-4">{{ $order[0]->total_pay }}.000đ</strong>
        </div>
        <div class="">
            @if ($od->status == 'To Receive')
                <a href="/receivedStatus?id={{ $order[0]->o_id }}" class="btn btn-danger px-5"
                    onclick="return confirm('Chắc chắn rằng đơn hàng đã giao đến bạn và bạn đã nhận được hàng?')">Đã Nhận
                    Được Hàng</a>
            @elseif ($od->status == 'To Review')
                <a href="#" class="btn btn-danger px-5" onclick="review({{ $order[0]->o_id }})">Đánh Giá</a>
            @elseif ($od->status == 'Done')
                <a href="#" class="btn btn-danger px-5 disabled">Hoàn Thành</a>
            @elseif($od->status == 'To Cancel')
                <a href="#" class="btn btn-danger px-5 disabled">Đang chờ xác nhận</a>
            @elseif($od->status == 'Initialized' || $od->status == 'Confirmed' || $od->status == 'To Delivery')
                <form action="{{ url('/cancelOrder') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $order[0]->o_id }}">
                    <div class="text-end">
                        <input type="text" name="reason" placeholder="Lý do" class="form-control" required>
                        <button type="submit" class="btn btn-outline-secondary mt-2">Hủy Đơn Hàng</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
    </div>
    </div>

    {{-- Review --}}
    <div class="modal fade" id="reviewModal-{{ $order[0]->o_id }}" tabindex="-1" aria-labelledby="reviewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('/submitReview') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="reviewModalLabel">Đánh Giá Sản Phẩm</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @foreach ($order as $index => $od)
                            <!-- Thông tin sản phẩm -->
                            <div class="d-flex">
                                <div class="me-3"><img src="{{ asset('FE/img/products/' . $od->pro_image) }}"
                                        alt="" style="width: 64px; hieght: 64px;"></div>
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

                            <!-- Đánh giá sản phẩm -->
                            <div class="mb-3">
                                <label for="rating_{{ $index }}" class="form-label">Chất lượng sản phẩm</label>
                                <select name="rating[]" id="rating_{{ $index }}" class="form-select" required>
                                    <option value="5">⭐⭐⭐⭐⭐ Tuyệt vời</option>
                                    <option value="4">⭐⭐⭐⭐ Ngon</option>
                                    <option value="3">⭐⭐⭐ Bình thường</option>
                                    <option value="2">⭐⭐ Tạm Được</option>
                                    <option value="1">⭐ Rất Tệ</option>
                                </select>
                            </div>

                            <!-- Nhận xét -->
                            <div class="mb-3">
                                <label for="comment_{{ $index }}" class="form-label">Nhận xét</label>
                                <textarea name="comment[]" id="comment_{{ $index }}" class="form-control" rows="3" required></textarea>
                            </div>

                            <!-- Ẩn pro_id để biết sản phẩm nào đang được đánh giá -->
                            <input type="hidden" name="pro_id[]" value="{{ $od->pro_id }}">
                            <input type="hidden" name="o_id[]" value="{{ $od->o_id }}">
                        @endforeach
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Trở Lại</button>
                        <button type="submit" class="btn btn-primary">Hoàn Thành</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
    </div>
    <script>
        function review(id) {
            var reviewModal = new bootstrap.Modal(document.getElementById('reviewModal-' + id), {
                keyboard: false
            });
            reviewModal.show();
        }
    </script>
@endsection
