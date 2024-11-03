@extends('layouts.homeLayout')

@section('homeContent')
    <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('/products/review') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="reviewModalLabel">Đánh Giá Sản Phẩm</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @foreach ($orderDetails as $index => $od)
                            <!-- Thông tin sản phẩm -->
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


    <!-- Script to trigger the modal on page load -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var reviewModal = new bootstrap.Modal(document.getElementById('reviewModal'), {
                keyboard: false
            });
            reviewModal.show();
        });
    </script>
@endsection
