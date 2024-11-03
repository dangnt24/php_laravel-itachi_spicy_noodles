@extends('layouts.homeLayout')
@section('homeContent')
    <div class="row mt-3">
        <div class="col-12 topnav-detail">
            <a href="{{ URL::to('/') }}" class="text-decoration-none topnav-detail__item">Trang chủ</a> > Giỏ hàng
        </div>
    </div>
    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 0;
        }
    </style>
    <?php $total_pay = 0; ?>
    @if (Session::get('cart'))
        <form action="{{ URL::to('/cart/deleteManyItems') }}" method="post">
            {{ csrf_field() }}
            <button type="submit" id="deleteButton" class="btn btn-danger mt-4" disabled
                onclick="return confirm('Are you sure you want to delete selected items?');">
                <i class="fa-solid fa-trash cart-responsive-hidden"></i><span class=""> Xóa</span>
            </button>
            <div class="container mt-3 d-flex">
                <div class="row body-cart__item align-items-center mb-3 justify-content-center">
                    <div class="row mb-3 cart-responsive-hidden">
                        <div class="col-1">
                            <span class="custom-checkbox">
                                <input type="checkbox" id="selectAll" style="cursor: pointer;">
                            </span>
                        </div>
                        <div class="col-1"></div>
                        <div class="col-10">
                            <div class="row">
                                <div class="col-4">Sản Phẩm</div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-4">Đơn Giá</div>
                                        <div class="col-4">Số Lượng</div>
                                        <div class="col-4 p-0">Thành Tiền</div>
                                    </div>
                                </div>
                                <div class="col-2">Thao Tác</div>
                            </div>
                        </div>
                    </div>

                    @foreach (Session::get('cart') as $key => $item)
                        <div class="row align-items-center my-4">
                            <div class="col-1">
                                <span class="custom-checkbox">
                                    <input type="checkbox" name="keys[]" value="{{ $key }}"
                                        class="selectAll__item" style="cursor: pointer;">
                                </span>
                            </div>

                            <div class="col-md-1 col-3">
                                <img src="{{ asset('FE/img/products/' . $item['image']) }}" alt="Image"
                                    class="img-fluid body-cart__img">
                            </div>

                            <div class="col-md-10 col-8">
                                <div class="row align-items-center">
                                    <div class="col-md-4 col-12">
                                        <div class="body-cart__title">{{ $item['title'] }}</div>
                                        <?php
                                        $note = [];
                                        if ($item['level']) {
                                            array_push($note, $item['level'] . 'đ');
                                        }
                                        if ($item['isFresh']) {
                                            array_push($note, 'Để sống');
                                        }
                                        if ($item['note']) {
                                            array_push($note, $item['note']);
                                        }
                                        ?>
                                        <div class="text-wrap text-secondary">
                                            {{ $item['level'] || $item['isFresh'] || $item['note'] ? 'Ghi chú: ' : '' }}{{ $note ? join(', ', $note) : '' }}
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-10">
                                        <div class="row">
                                            <div class="col-md-4 col-12 price mt-2">{{ $item['price'] }}.000đ</div>

                                            <div class="col-md-4 col-6 body-cart__quantity mt-1"
                                                style="padding: 0;display: flex;">
                                                <a role="button" href="?action=decrease&key={{ $key }}"
                                                    class="btn btn-light" style="border: 1px solid #ddd; padding: 0 6px;"
                                                    id="btnDecrease">-</a>
                                                <input type="number" name="quantity" id="quantity" min="1"
                                                    value="{{ $item['quantity'] }}"
                                                    style="width: 40px; padding: 0; border-radius: 0; border: 0; text-align: center;">
                                                <a role="button" href="?action=increase&key={{ $key }}"
                                                    class="btn btn-light" style="border: 1px solid #ddd; padding: 0 6px;"
                                                    id="btnIncrease">+</a>
                                            </div>

                                            <div class="col-md-4 col-6 price mt-2 cart-responsive-hidden">
                                                {{ $item['total_money'] }}.000đ</div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-1 body-cart__delete"><a href="?key={{ $key }}"
                                            class="text-decoration-none text-danger"><i
                                                class="fa-solid fa-trash cart-responsive-hidden"></i><span class="">
                                                Xóa</span></a></div>
                                </div>
                            </div>
                        </div>
                        <?php $total_pay += $item['total_money']; ?>
                    @endforeach
                </div>
            </div>

            <div class="text-end" style="margin-bottom: 5rem;">
                <div class="row">
                    <input type="hidden" name="total_payment" value="{{ $total_pay }}">
                    <div class="col-md-12 col-12 fs-3 text-end mt-3">Tổng thanh toán: <span
                            class="price fs-3 ms-3">{{ $total_pay }}.000đ</span></div>
                    <div class="col-md-12 col-12 text-end mt-3">
                        <a class="btn cart__buy ms-3 me-3 text-decordration-none"
                            href="{{ URL::to('/payment?total_pay=' . $total_pay . '&username=' . Session::get('username')) }}"><i
                                class="fa-solid fa-check me-1"></i> Mua hàng</a>
                    </div>
                </div>
            </div>
        </form>
        <style>
            #footer {
                display: none;
            }
        </style>
    @else
        <div class="d-flex flex-column align-items-center mb-5 cart-layout">
            <img src="{{ asset('FE/img/banners/cart-empty.png') }}" class="img-fluid" alt="Empty" style="width: 220px">
            <span>Giỏ hàng trống</span>
            <div>
                <a role="button" href="{{ URL::to('/') }}" class="btn btn-danger btn-sm mt-3">Quay về trang chủ</a>
            </div>
        </div>
    @endif

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var checkbox = document.querySelectorAll('.selectAll__item');
            var selectAll = document.querySelector("#selectAll");
            var deleteButton = document.getElementById("deleteButton");

            checkbox.forEach(function(item) {
                item.onclick = function() {
                    var isSelectAll = true;
                    var isDisabled = true;
                    checkbox.forEach(function(item) {
                        if (!item.checked) {
                            isSelectAll = false;
                        } else {
                            isDisabled = false;
                        }
                    });
                    selectAll.checked = isSelectAll;
                    deleteButton.disabled = isDisabled;
                }
            });

            selectAll.onclick = function() {
                if (this.checked) {
                    checkbox.forEach(function(item) {
                        item.checked = true;
                        deleteButton.disabled = false;
                    });
                } else {
                    checkbox.forEach(function(item) {
                        item.checked = false;
                        deleteButton.disabled = true;
                    });
                }
            }
        });
    </script>
@endsection
