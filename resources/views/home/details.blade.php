@extends('layouts.homeLayout')
@section('homeContent')
    <div class="row mt-3">
        <div class="col-12 topnav-detail">
            <a href="{{ URL::to('/') }}" class="text-decoration-none topnav-detail__item">Trang chủ</a> >
            {{ $result->pro_name }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-0 detail-nav-responsive">
            <div class="box-sale-policy mt-3">
                <h3><span>Chính sách bán hàng</span></h3>
                <div class="sale-policy-block">
                    <ul>
                        <li>Giao hàng TOÀN QUỐC</li>
                        <li>Thanh toán khi nhận hàng</li>
                        <li>Đổi trả trong <span>15 ngày</span></li>
                        <li>Hoàn ngay tiền mặt</li>
                        <li>Chất lượng đảm bảo</li>
                        <li>Miễn phí vận chuyển:<span>Đơn hàng từ 3 món trở lên</span></li>
                    </ul>
                </div>
                <div class="buy-guide mt-3">
                    <h3>Hướng Dẫn Mua Hàng</h3>
                    <ul>
                        <li>
                            Mua hàng trực tiếp tại website
                            <b class=""> itachispicynoodles.com</b>
                        </li>
                        <li>
                            Gọi điện thoại
                            <a href="tel:0123456789" style="color: #000; text-decoration: none;">
                                <strong class="">
                                    0123456789
                                </strong></a> để mua hàng
                        </li>
                        <li>
                            Mua tại Tiệm mỳ cay Itachi: <strong class="">Số 1, Lý Tự Trọng, Ninh Kiều, Cần
                                Thơ</strong>
                        </li>
                        <li>
                            Mua sỉ/buôn xin gọi
                            <a href="tel:0123456789" style="color: #000; text-decoration: none;">
                                <strong class="">
                                    0123456789
                                </strong></a> để được
                            hỗ trợ.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-sm-12 mt-3">
            <div class="row">
                <div class="col-md-6 col-sm-12 mb-3 mt-5 detail__image--responsive">
                    <img src="{{ 'FE/img/products/' . $result->pro_image }}" alt="Product" class="img-fluid">
                </div>
                <div class="col-md-6 col-sm-12 mt-5">
                    <div class="detailProduct">
                        <h3 class="text-black-50 mb-3">THÔNG TIN CHI TIẾT</h3>
                        <form method="post" style="display: block;">
                            {{ csrf_field() }}
                            <input type="hidden" name="pro_id" value="{{ $result->pro_id }}">
                            <input type="hidden" name="price" value="{{ $result->pro_price }}">
                            <div class="detailProduct__title">
                                <h4>{{ $result->pro_name }}</h4>
                            </div>
                            <div class="detailProduct__price mb-4">{{ $result->pro_price }},000đ</div>
                            <div class="detailProduct__description mb-3">{{ $result->pro_description }}</div>

                            @if ($result->c_id == 1 || $result->c_id == 2)
                                <div class="form-outline mb-3">
                                    <select class="detailProduct__level form-control" name="level">
                                        <option value="0" selected>Cấp độ 0 (mặc định)</option>
                                        <option value="1">Cấp độ 1</option>
                                        <option value="2">Cấp độ 2</option>
                                        <option value="3">Cấp độ 3</option>
                                        <option value="4">Cấp độ 4</option>
                                        <option value="5">Cấp độ 5</option>
                                        <option value="6">Cấp độ 6</option>
                                        <option value="7">Cấp độ 7</option>
                                    </select>
                                    <span class="mt-1 ms-3" style="color: red; display: block;">+ Cấp độ 0: không cay (có
                                        kèm
                                        bột cay để riêng)</span>
                                </div>
                                <div class="form-outline mb-3">
                                    <select class="detailProduct__processing form-control" name="isFresh">
                                        <option value="0" selected>Làm chín (mặc định)</option>
                                        <option value="1">Để tươi sống</option>
                                    </select>
                                </div>
                            @endif

                            <div>
                                <div for="">Số lượng</div>
                                <input type="number" name="quantity" id="quantity"
                                    class="form-control detailProduct__quantity mb-3" value="1" min="1">
                            </div>

                            <div>
                                <div>Ghi chú</div>
                                <textarea name="note" id="note" cols="30" rows="3" class="form-control"></textarea>
                            </div>

                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn detailProduct__addcart me-2" name="addcart"
                                    value="yes"><i class="fa-solid fa-cart-shopping me-1"></i> Thêm vào giỏ hàng</button>
                                <button type="submit" class="btn detailProduct__buy" name="buynow" value="yes"><i
                                        class="fa-solid fa-check me-1"></i> Mua hàng</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reviews -->
    @if ($totalReviews > 0)
        <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab" id="review">
            <h4 class="pt-4 pb-3">ĐÁNH GIÁ SẢN PHẨM</h4>

            <div class="d-flex align-items-center px-4 py-5 w-100 mb-4" style="background-color: #fffbf8; border: 1px solid #f9ede5;">
                <div class="me-4">
                    <div>
                        <h3 class="text-danger">{{ number_format($averageRating, 1) }} Trên 5</h3>
                    </div>
                    <div style="word-spacing: -5px;">
                        @for ($i = 0; $i < 5; $i++)
                            @if ($i < floor($averageRating))
                                <!-- Sao đầy -->
                                <i class="fa-solid fa-star text-danger" style="font-size: 1.25rem"></i>
                            @elseif ($i < $averageRating)
                                <!-- Sao nửa đầy nếu averageRating nằm giữa số nguyên -->
                                <i class="fa-solid fa-star-half-stroke text-danger" style="font-size: 1.25rem"></i>
                            @else
                                <!-- Sao trống -->
                                <i class="fa-regular fa-star text-danger" style="font-size: 1.25rem"></i>
                            @endif
                        @endfor
                    </div>
                </div>

                <div class="ms-4" style="min-width: 300px;">
                    @foreach ($ratingBreakdown as $stars => $count)
                        <div class="rating-bar {{ number_format($count) > 0 ? '' : 'd-none' }}">
                            <span>{{ $stars }} <i class="fa-solid fa-star text-danger"
                                    style="font-size: 12px;"></i></span>
                            <div class="bar">
                                @php
                                    $widthPercentage = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
                                @endphp
                                <span class="bg-danger rounded" style="width: {{ $widthPercentage }}%;"></span>
                                <span class=""
                                    style="background-color: transparent; top: -5px; margin-left: {{ $widthPercentage + 4 }}%;">{{ number_format($count) }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div id="reviewContainer">
                @foreach ($reviews as $review)
                    <div class="review-item">
                        <div class="d-flex mb-3">
                            <img src="{{ asset('FE/img/avatars/' . $review->avatar) }}" class="img-fluid rounded-circle p-3"
                                style="width: 100px; height: 100px;" alt="">
                            <div style="width: 1000px; max-width: 100%">
                                <div>
                                    <h5>{{ $review->fullname }}</h5>
                                    <div class="d-flex my-2">
                                        @for ($i = 0; $i < 5; $i++)
                                            @if ($i < $review->rating)
                                                <i class="fa-solid fa-star text-danger" style="font-size: 12px"></i>
                                            @else
                                                <i class="fa-regular fa-star text-danger" style="font-size: 12px"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <p class="mb-2 text-muted" style="font-size: 12px;">{{ $review->created_at }}</p>
                                </div>
                                <div class="row">
                                    <div class="col-md-8 col-12">{{ $review->comment }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Placeholder for pagination controls -->
            <div id="paginationControls" class="pagination justify-content-center" style="margin-top: 24px;"></div>

        </div>
    @endif

    @if ($relatedProducts || $extraDish)
        <div class="product-carousel mt-5">
            <h5 class="product-carousel-header">SẢN PHẨM LIÊN QUAN</h5>

            <div class="owl-carousel owl-theme">
                @if ($extraDish)
                    @foreach ($extraDish as $item)
                        <div class="item product-carousel-item" title="{{ $item->pro_name }}">
                            <a href="{{ URL::to('/details?id=' . $item->pro_id) }}"
                                style="text-decoration: none; color: #333;">
                                <div class="product-carousel-head">
                                    <img src="{{ asset('FE/img/products/' . $item->pro_image) }}"
                                        class="product-carousel-img">
                                </div>
                                <div class="product-carousel-body">
                                    <h5 class="product-carousel-title">{{ $item->pro_name }}</h5>
                                    <p class="product-carousel-price">{{ $item->pro_price }}.000 ₫</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
                @if ($relatedProducts)
                    @foreach ($relatedProducts as $item)
                        <div class="item product-carousel-item" title="{{ $item->pro_name }}">
                            <a href="{{ URL::to('/details?id=' . $item->pro_id) }}"
                                style="text-decoration: none; color: #333;">
                                <div class="product-carousel-head">
                                    <img src="{{ asset('FE/img/products/' . $item->pro_image) }}"
                                        class="product-carousel-img">
                                </div>
                                <div class="product-carousel-body">
                                    <h5 class="product-carousel-title">{{ $item->pro_name }}</h5>
                                    <p class="product-carousel-price">{{ $item->pro_price }}.000 ₫</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    @endif
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const itemsPerPage = 3; // Number of reviews per page
            const reviewContainer = document.getElementById("reviewContainer");
            const paginationControls = document.getElementById("paginationControls");
            const reviewItems = Array.from(document.querySelectorAll(".review-item"));
            const totalPages = Math.ceil(reviewItems.length / itemsPerPage);

            function renderPage(page) {
                // Hide all reviews
                reviewItems.forEach((item, index) => {
                    item.style.display = "none";
                    if (index >= (page - 1) * itemsPerPage && index < page * itemsPerPage) {
                        item.style.display = "block";
                    }
                });
                if (totalPages > 1) {
                    renderPaginationControls(page);
                } else {
                    paginationControls.innerHTML = ""; // Xóa thanh phân trang nếu không cần thiết
                }
            }

            function renderPaginationControls(currentPage) {
                paginationControls.innerHTML = "";
                const paginationList = document.createElement("ul");
                paginationList.classList.add("pagination");

                // Previous button with Font Awesome icon
                const prevItem = document.createElement("li");
                prevItem.classList.add("page-item");
                prevItem.classList.toggle("disabled", currentPage === 1);
                prevItem.innerHTML = `<a class="page-link" href="#review"><i class="fa-solid fa-chevron-left"></i></a>`;
                prevItem.addEventListener("click", () => {
                    if (currentPage > 1) renderPage(currentPage - 1);
                });
                paginationList.appendChild(prevItem);

                // Always show first page
                appendPageNumber(paginationList, 1, currentPage);

                // Calculate range of middle pages
                let startPage = Math.max(2, currentPage - 2);
                let endPage = Math.min(totalPages - 1, currentPage + 2);

                // Ellipsis after first page
                if (startPage > 2) {
                    appendEllipsis(paginationList);
                }

                // Middle page numbers
                for (let i = startPage; i <= endPage; i++) {
                    appendPageNumber(paginationList, i, currentPage);
                }

                // Ellipsis before last page
                if (endPage < totalPages - 1) {
                    appendEllipsis(paginationList);
                }

                // Always show last page
                appendPageNumber(paginationList, totalPages, currentPage);

                // Next button with Font Awesome icon
                const nextItem = document.createElement("li");
                nextItem.classList.add("page-item");
                nextItem.classList.toggle("disabled", currentPage === totalPages);
                nextItem.innerHTML = `<a class="page-link" href="#review"><i class="fa-solid fa-chevron-right"></i></a>`;
                nextItem.addEventListener("click", () => {
                    if (currentPage < totalPages) renderPage(currentPage + 1);
                });
                paginationList.appendChild(nextItem);

                paginationControls.appendChild(paginationList);
            }

            function appendPageNumber(paginationList, pageNumber, currentPage) {
                const pageItem = document.createElement("li");
                pageItem.classList.add("page-item");
                if (pageNumber === currentPage) pageItem.classList.add("active");
                pageItem.innerHTML = `<a class="page-link" href="#review">${pageNumber}</a>`;
                pageItem.addEventListener("click", () => renderPage(pageNumber));
                paginationList.appendChild(pageItem);
            }

            function appendEllipsis(paginationList) {
                const ellipsisItem = document.createElement("li");
                ellipsisItem.classList.add("page-item", "disabled");
                ellipsisItem.innerHTML = `<span class="page-link">...</span>`;
                paginationList.appendChild(ellipsisItem);
            }

            // Initial render
            renderPage(1);
        });
    </script>

@endsection
