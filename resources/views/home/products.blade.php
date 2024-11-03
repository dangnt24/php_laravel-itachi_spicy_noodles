@extends('layouts.homeLayout')
@section('homeContent')
    <div class="menu">
        <div class="row">
            <div class="col-md-3 col-12">
                <div class="menu-category">
                    <div class="menu-category__heading">
                        <h5>Danh mục món</h5>
                        <div><i class="fa-solid fa-bars" style="font-size: 24px;"></i></div>
                    </div>
                    <ul class="menu-category__list">
                        <li class="menu-category__item <?php echo $active == 0 ? 'active' : ''; ?>"><a href="{{ URL::to('/') }}">Tất cả</a></li>
                        @foreach ($categories as $item)
                            <li class="menu-category__item <?php echo $active == $item->c_id ? 'active' : ''; ?>"><a
                                    href="?category={{ $item->c_id }}">{{ $item->c_name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-md-9 col-12">
                <div class="row">
                    <div class="col-12">
                        <h3 class="menu-product__heading">Sản phẩm</h3>
                    </div>
                    <div class="col-12">
                        <hr class="menu-product__hr">
                    </div>
                </div>

                <div id="productContainer" class="row">
                    @foreach ($products as $product)
                        <div class="col-lg-3 col-6 product-item" title="{{ $product->pro_name }}">
                            <a href="{{ URL::to('/details?id=' . $product->pro_id) }}"
                                style="text-decoration: none; color: #333;">
                                <div class="menu-product-head">
                                    <img src="{{ 'FE/img/products/' . $product->pro_image }}"
                                        class="menu-product-img img-fluid">
                                </div>
                                <div class="menu-product-body">
                                    <h5 class="menu-product-title">{{ $product->pro_name }}</h5>
                                    <p class="menu-product-price">{{ $product->pro_price }}.000 ₫</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Placeholder for pagination controls -->
            <div id="paginationControls" class="pagination-controls" style="margin-top: 24px; text-align: center;"></div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const itemsPerPage = 12; // Number of items per page
            const productContainer = document.getElementById("productContainer");
            const paginationControls = document.getElementById("paginationControls");
            const productItems = Array.from(document.querySelectorAll(".product-item"));
            if (productItems.length <= itemsPerPage) return;
            const totalPages = Math.ceil(productItems.length / itemsPerPage);

            function renderPage(page) {
                // Hide all products
                productItems.forEach((item, index) => {
                    item.style.display = "none";
                    if (index >= (page - 1) * itemsPerPage && index < page * itemsPerPage) {
                        item.style.display = "block";
                    }
                });
                renderPaginationControls(page);
            }

            function renderPaginationControls(currentPage) {
                paginationControls.innerHTML = "";
                const paginationList = document.createElement("ul");
                paginationList.classList.add("pagination");

                // Previous button with Font Awesome icon
                const prevItem = document.createElement("li");
                prevItem.classList.add("page-item");
                prevItem.classList.toggle("disabled", currentPage === 1);
                prevItem.innerHTML = `<a class="page-link" href="#"><i class="fa-solid fa-chevron-left"></i></a>`;
                prevItem.addEventListener("click", () => {
                    if (currentPage > 1) renderPage(currentPage - 1);
                });
                paginationList.appendChild(prevItem);

                // Page numbers
                if (totalPages > 1) {
                    // Always show first page
                    appendPageNumber(paginationList, 1, currentPage);

                    // Calculate the range of middle pages to show
                    let startPage = Math.max(2, currentPage - 2);
                    let endPage = Math.min(totalPages - 1, currentPage + 2);

                    // Show ellipsis if there's a gap between first page and startPage
                    if (startPage > 2) {
                        appendEllipsis(paginationList);
                    }

                    // Append middle pages
                    for (let i = startPage; i <= endPage; i++) {
                        appendPageNumber(paginationList, i, currentPage);
                    }

                    // Show ellipsis if there's a gap between endPage and last page
                    if (endPage < totalPages - 1) {
                        appendEllipsis(paginationList);
                    }

                    // Always show last page
                    appendPageNumber(paginationList, totalPages, currentPage);
                }

                // Next button with Font Awesome icon
                const nextItem = document.createElement("li");
                nextItem.classList.add("page-item");
                nextItem.classList.toggle("disabled", currentPage === totalPages);
                nextItem.innerHTML = `<a class="page-link" href="#"><i class="fa-solid fa-chevron-right"></i></a>`;
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
                pageItem.innerHTML = `<a class="page-link" href="#">${pageNumber}</a>`;
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
