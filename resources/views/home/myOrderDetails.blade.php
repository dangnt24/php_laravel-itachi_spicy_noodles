@extends('layouts.homeLayout')
@section('homeContent')
    <div class="container px-5 py-3" id="myOrderDetails">
        <div class="d-flex justify-content-between pb-5">
            <div>
                <a href="{{ route('myOrders') }}" class="a-reset text-muted"><i class="fa-solid fa-angle-left"></i> TRỞ LẠI</a>
            </div>
            @php
                $status = [
                    'Initialized' => 'Đơn Hàng Đã Đặt',
                    'Confirmed' => 'Đơn Hàng Đã Xác Nhận Thành Công',
                    'To Delivery' => 'Chờ Lấy Hàng',
                    'To Receive' => 'Đang Giao',
                    'To Review' => 'Chờ Đánh Giá',
                    'Done' => 'Hoàn Thành',
                    'To Cancel' => 'Đang Xác Nhận Hủy',
                    'Canceled' => 'Đã Hủy',
                ];
            @endphp
            <div class="{{ $orderItem->status == 'Canceled' ? 'text-danger' : 'text-success' }} text-uppercase">
                {{ $status[$orderItem->status] }}</div>
        </div>

        <div class="d-flex justify-content-between position-relative align-items-baseline">
            <div class="progress-step position-relative {{ $orderItem->status == 'Initialized' ? 'active' : '' }}">
                <div class="icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="title">Đơn Hàng Đã Đặt</div>
                <div class="date">{{ \Carbon\Carbon::parse($orderItem->created_at)->format('Y-m-d H:i') }}</div>
                <div class="progress-line"></div>
            </div>

            <div class="progress-step position-relative {{ $orderItem->status == 'Confirmed' ? 'active' : '' }}">
                <div class="icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="title" style="max-width: 140px">Đã Xác Nhận Thông Tin Thanh Toán</div>
                <div class="progress-line"></div>
            </div>

            <div class="progress-step position-relative {{ $orderItem->status == 'To Delivery' ? 'active' : '' }}">
                <div class="icon">
                    <i class="fas fa-truck"></i>
                </div>
                <div class="title">Chờ Lấy Hàng</div>
                <div class="progress-line"></div>
            </div>

            <div
                class="progress-step position-relative {{ $orderItem->status == 'To Receive' || $orderItem->status == 'To Review' ? 'active' : '' }}">
                <div class="icon">
                    <i class="fas fa-shipping-fast"></i>
                </div>
                <div class="title">Đang Giao</div>
                <div class="progress-line"></div>
            </div>

            <div class="progress-step {{ $orderItem->status == 'Done' ? 'active' : '' }}">
                <div class="icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="title">Đánh Giá</div>
            </div>
        </div>
    </div>

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

        <hr class="mt-0">
        <div class="d-flex justify-content-between">
            <div class="text-muted" style="max-width: 50%"><span class="fw-bold text-dark">
                    @if ($od->order_note)
                        Lưu ý:
                </span>{{ $od->order_note }}
                @endif
            </div>
            <div>
                <div class="text-end mb-3">
                    <span class="me-2">Thành tiền: </span>
                    <strong class="fs-4">{{ $od->total_pay }}.000đ</strong>
                </div>
                <div class="">
                    @if ($od->status == 'To Receive')
                        <a href="{{ route('receivedStatus', ['id' => $orderItem->o_id]) }}" class="btn btn-danger px-5"
                            onclick="return confirm('Chắc chắn rằng đơn hàng đã giao đến bạn và bạn đã nhận được hàng?')">Đã Nhận
                            Được Hàng</a>
                    @elseif ($od->status == 'To Review')
                        <a href="#" class="btn btn-danger px-5" onclick="review({{ $orderItem->o_id }})">Đánh Giá</a>
                    @elseif ($od->status == 'Done')
                        <a href="#" class="btn btn-danger px-5 disabled">Hoàn Thành</a>
                    @elseif($od->status == 'To Cancel')
                        <a href="#" class="btn btn-danger px-5 disabled">Đang chờ xác nhận</a>
                    @elseif($od->status == 'Initialized' || $od->status == 'Confirmed' || $od->status == 'To Delivery')
                        <form action="{{ url('/cancelOrder') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $orderItem->o_id }}">
                            <input type="hidden" name="status" value="{{ $orderItem->status }}">
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
    <div class="modal fade" id="reviewModal-{{ $orderItem->o_id }}" tabindex="-1" aria-labelledby="reviewModalLabel"
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
                        @foreach ($orderDetails as $index => $od)
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

    <script>
        const activeItem = document.querySelector('.progress-step.active');

        if (activeItem) {
            let sibling = activeItem.previousElementSibling;
            while (sibling) {
                if (sibling.classList.contains('progress-step')) {
                    sibling.classList.add('done');
                }
                sibling = sibling.previousElementSibling;
            }
        }

        function review(id) {
            var reviewModal = new bootstrap.Modal(document.getElementById('reviewModal-' + id), {
                keyboard: false
            });
            reviewModal.show();
        }
    </script>
@endsection
