@extends('frontend.master')
@section('content')
    <!-- breadcrumb_section - start
                                    ================================================== -->
    <div class="breadcrumb_section">
        <div class="container">
            <ul class="breadcrumb_nav ul_li">
                <li><a href="index.html">Home</a></li>
                <li>Product Grid</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb_section - end
                                    ================================================== -->
    <!-- product_section - start
                                    ================================================== -->
    <section class="product_section section_space">
        <h2 class="hidden">Product sidebar</h2>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <aside class="sidebar_section p-0 mt-0">
                        <div class="sb_widget sb_category">
                            <h3 class="sb_widget_title">Categories</h3>
                            <ul class="sb_category_list ul_li_block">
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="{{ url('/filter/category/product', $category->id) }}">{{ $category->category_name }}
                                            <span>({{ $category->rel_to_product->count() }})</span></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="sb_widget">
                            <h3 class="sb_widget_title">Your Filter</h3>
                            <div class="filter_sidebar">
                                <div class="fs_widget">
                                    <h3 class="fs_widget_title">Category</h3>
                                    <form action="#">
                                        <div class="select_option clearfix">
                                            <select>
                                                <option data-display="Select Category">Select Your Option</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </form>
                                </div>

                                <div class="fs_widget">
                                    <h3 class="fs_widget_title">Manufacturer</h3>
                                    <form action="#">
                                        <ul class="fs_brand_list ul_li_block">
                                            @foreach ($categories as $category)
                                                <li>
                                                    <div class="checkbox_item">
                                                        <input id="category_id{{ $category->id }}" type="checkbox"
                                                            name="category_name" />
                                                        <label
                                                            for="category_id{{ $category->id }}">{{ $category->category_name }}
                                                            <span>({{ $category->rel_to_product->count() }})</span></label>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>

                <div class="col-lg-9">
                    <div class="filter_topbar">
                        <div class="row align-items-center">
                            <div class="col col-md-4">
                                <ul class="layout_btns nav" role="tablist">
                                    <li>
                                        <button class="active" data-bs-toggle="tab" data-bs-target="#home" type="button"
                                            role="tab" aria-controls="home" aria-selected="true"><i
                                                class="fal fa-bars"></i></button>
                                    </li>
                                    <li>
                                        <button data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab"
                                            aria-controls="profile" aria-selected="false">
                                            <i class="fal fa-th-large"></i>
                                        </button>
                                    </li>
                                </ul>
                            </div>

                            <div class="col col-md-4">

                                <select onchange="sortProduct()" id="sortby" class="form-select">
                                    <option {{ ($sort_text == 'default' ? 'selected' : '') }} value="default">Select Your Option</option>
                                    <option {{ ($sort_text == 'sortNewest' ? 'selected' : '') }} value="sortNewest">Sorting By Newest</option>
                                    <option {{ ($sort_text == 'sortOldest' ? 'selected' : '') }} value="sortOldest">Sorting By Oldest</option>
                                    <option {{ ($sort_text == 'sortPriceASC' ? 'selected' : '') }} value="sortPriceASC">Price - Low to High</option>
                                    <option {{ ($sort_text == 'sortPriceDESC' ? 'selected' : '') }} value="sortPriceDESC">Price - High to Low</option>
                                </select>


                            </div>

                            <div class="col col-md-4">
                                <div class="result_text">Showing 1 - 9 of {{ $total_products }} results</div>
                            </div>
                        </div>
                    </div>

                    <hr />

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="home" role="tabpanel">
                            <div class="shop-product-area shop-product-area-col">
                                <div class="product-area shop-grid-product-area clearfix">
                                    @foreach ($products as $item)
                                        <div class="grid">
                                            <div class="product-pic">
                                                <img src="{{ asset('/uploads/products/preview') }}/{{ $item->product_preview }}"
                                                    alt />
                                                @if ($item->product_discount)
                                                    <span class="theme-badge-2">{{ $item->product_discount }}% off</span>
                                                @endif
                                                <div class="actions">
                                                    <ul>
                                                        <li class="add_wishlist">
                                                            <input type="hidden" class="product_id" name="product_id"
                                                                value="{{ $item->id }}">
                                                            <a href="">
                                                                <svg role="img" xmlns="http://www.w3.org/2000/svg"
                                                                    width="48px" height="48px" viewBox="0 0 24 24"
                                                                    stroke="#2329D6" stroke-width="1"
                                                                    stroke-linecap="square" stroke-linejoin="miter"
                                                                    fill="none" color="#2329D6">
                                                                    <title>Favourite</title>
                                                                    <path
                                                                        d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z" />
                                                                </svg>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <svg role="img" xmlns="http://www.w3.org/2000/svg"
                                                                    width="48px" height="48px" viewBox="0 0 24 24"
                                                                    stroke="#2329D6" stroke-width="1"
                                                                    stroke-linecap="square" stroke-linejoin="miter"
                                                                    fill="none" color="#2329D6">
                                                                    <title>Shuffle</title>
                                                                    <path
                                                                        d="M21 16.0399H17.7707C15.8164 16.0399 13.9845 14.9697 12.8611 13.1716L10.7973 9.86831C9.67384 8.07022 7.84196 7 5.88762 7L3 7" />
                                                                    <path
                                                                        d="M21 7H17.7707C15.8164 7 13.9845 8.18388 12.8611 10.1729L10.7973 13.8271C9.67384 15.8161 7.84196 17 5.88762 17L3 17" />
                                                                    <path d="M19 4L22 7L19 10" />
                                                                    <path d="M19 13L22 16L19 19" />
                                                                </svg>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="quickview_btn" data-bs-toggle="modal"
                                                                href="#quickview_popup{{ $item->id }}" role="button"
                                                                tabindex="0">
                                                                <svg width="48px" height="48px" viewBox="0 0 24 24"
                                                                    xmlns="http://www.w3.org/2000/svg" stroke="#2329D6"
                                                                    stroke-width="1" stroke-linecap="square"
                                                                    stroke-linejoin="miter" fill="none"
                                                                    color="#2329D6">
                                                                    <title>Visible (eye)</title>
                                                                    <path
                                                                        d="M22 12C22 12 19 18 12 18C5 18 2 12 2 12C2 12 5 6 12 6C19 6 22 12 22 12Z" />
                                                                    <circle cx="12" cy="12"
                                                                        r="3" />
                                                                </svg>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="details">
                                                <h4><a
                                                        href="{{ route('product.details', $item->id) }}">{{ $item->product_name }}</a>
                                                </h4>
                                                <p><a
                                                        href="{{ route('product.details', $item->id) }}">{{ $item->short_description }}</a>
                                                </p>
                                                <div class="rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star-half-alt"></i>
                                                </div>
                                                <span class="price">
                                                    <ins>
                                                        <span class="woocommerce-Price-amount amount">
                                                            <bdi> <span class="woocommerce-Price-currencySymbol">৳
                                                                </span>{{ $item->after_discount }}</bdi>
                                                        </span>
                                                    </ins>
                                                    <del aria-hidden="true">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <bdi> <span class="woocommerce-Price-currencySymbol">৳
                                                                </span>{{ $item->product_price }}</bdi>
                                                        </span>
                                                    </del>
                                                </span>
                                                <div class="add-cart-area">
                                                    <button class="add-to-cart">Add to cart</button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- product quick view modal - start
                                                                    ================================================== -->
                                        <div class="modal fade" id="quickview_popup{{ $item->id }}"
                                            aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalToggleLabel2">Product
                                                            Quick View</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="product_details">
                                                            <div class="container">
                                                                <div class="row">
                                                                    <div class="col col-lg-6">
                                                                        <div class="product_details_image p-0">
                                                                            <img src="{{ asset('/uploads/products/preview') }}/{{ $item->product_preview }}"
                                                                                alt>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-6">
                                                                        <div class="product_details_content">
                                                                            <h2 class="item_title">
                                                                                {{ $item->product_name }}</h2>
                                                                            <p>
                                                                                {{ $item->short_description }}
                                                                            </p>
                                                                            <div class="item_review">
                                                                                <ul class="rating_star ul_li">
                                                                                    <li><i class="fas fa-star"></i></li>
                                                                                    <li><i class="fas fa-star"></i></li>
                                                                                    <li><i class="fas fa-star"></i></li>
                                                                                    <li><i class="fas fa-star"></i></li>
                                                                                    <li><i class="fas fa-star"></i></li>
                                                                                </ul>
                                                                                <span class="review_value">3
                                                                                    Rating(s)</span>
                                                                            </div>
                                                                            <div class="item_price">
                                                                                <span>TK {{ $item->after_discount }}</span>
                                                                                <del>TK {{ $item->product_price }}</del>
                                                                            </div>
                                                                            <hr>
                                                                            <div class="quantity_wrap">
                                                                                <form action="#">
                                                                                    <div class="quantity_input">
                                                                                        <button type="button"
                                                                                            class="input_number_decrement">
                                                                                            <i class="fal fa-minus"></i>
                                                                                        </button>
                                                                                        <input class="input_number"
                                                                                            type="text" value="1">
                                                                                        <button type="button"
                                                                                            class="input_number_increment">
                                                                                            <i class="fal fa-plus"></i>
                                                                                        </button>
                                                                                    </div>
                                                                                </form>
                                                                                <div class="total_price">
                                                                                    Total: TK {{ $item->after_discount }}
                                                                                </div>
                                                                            </div>

                                                                            <ul class="default_btns_group ul_li">
                                                                                <li><a class="addtocart_btn"
                                                                                        href="{{ route('product.details', $item->id) }}">Add
                                                                                        To Cart</a></li>
                                                                                <li><a href="#!"><i
                                                                                            class="far fa-compress-alt"></i></a>
                                                                                </li>
                                                                                <li><a href="#!"><i
                                                                                            class="fas fa-heart"></i></a>
                                                                                </li>
                                                                            </ul>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- product quick view modal - end
                                                                    ================================================== -->
                                    @endforeach

                                </div>
                            </div>

                            <div class="pagination_wrap">
                                <ul class="pagination_nav">
                                    {{ $products->links('vendor.pagination.bootstrap-4') }}
                                </ul>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="profile" role="tabpanel">
                            <div class="product_layout2_wrap">
                                <div class="product-area-row">
                                    @foreach ($products as $item)
                                        <div class="grid clearfix">
                                            <div class="product-pic">
                                                <img src="{{ asset('/uploads/products/preview') }}/{{ $item->product_preview }}"
                                                    alt />
                                                @if ($item->product_discount)
                                                    <span class="theme-badge-2">{{ $item->product_discount }}% off</span>
                                                @endif
                                                <div class="actions">
                                                    <ul>
                                                        <li>
                                                            <a href="#">
                                                                <svg role="img" xmlns="http://www.w3.org/2000/svg"
                                                                    width="48px" height="48px" viewBox="0 0 24 24"
                                                                    stroke="#2329D6" stroke-width="1"
                                                                    stroke-linecap="square" stroke-linejoin="miter"
                                                                    fill="none" color="#2329D6">
                                                                    <title>Favourite</title>
                                                                    <path
                                                                        d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z" />
                                                                </svg>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <svg role="img" xmlns="http://www.w3.org/2000/svg"
                                                                    width="48px" height="48px" viewBox="0 0 24 24"
                                                                    stroke="#2329D6" stroke-width="1"
                                                                    stroke-linecap="square" stroke-linejoin="miter"
                                                                    fill="none" color="#2329D6">
                                                                    <title>Shuffle</title>
                                                                    <path
                                                                        d="M21 16.0399H17.7707C15.8164 16.0399 13.9845 14.9697 12.8611 13.1716L10.7973 9.86831C9.67384 8.07022 7.84196 7 5.88762 7L3 7" />
                                                                    <path
                                                                        d="M21 7H17.7707C15.8164 7 13.9845 8.18388 12.8611 10.1729L10.7973 13.8271C9.67384 15.8161 7.84196 17 5.88762 17L3 17" />
                                                                    <path d="M19 4L22 7L19 10" />
                                                                    <path d="M19 13L22 16L19 19" />
                                                                </svg>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="quickview_btn" data-bs-toggle="modal"
                                                                href="#quickview_popup2{{ $item->id }}"
                                                                role="button" tabindex="0">
                                                                <svg width="48px" height="48px" viewBox="0 0 24 24"
                                                                    xmlns="http://www.w3.org/2000/svg" stroke="#2329D6"
                                                                    stroke-width="1" stroke-linecap="square"
                                                                    stroke-linejoin="miter" fill="none"
                                                                    color="#2329D6">
                                                                    <title>Visible (eye)</title>
                                                                    <path
                                                                        d="M22 12C22 12 19 18 12 18C5 18 2 12 2 12C2 12 5 6 12 6C19 6 22 12 22 12Z" />
                                                                    <circle cx="12" cy="12"
                                                                        r="3" />
                                                                </svg>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="details">
                                                <h4><a
                                                        href="{{ route('product.details', $item->id) }}">{{ $item->product_name }}</a>
                                                </h4>
                                                <p><a
                                                        href="{{ route('product.details', $item->id) }}">{{ $item->short_description }}</a>
                                                </p>
                                                <div class="rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star-half-alt"></i>
                                                </div>
                                                <span class="price">
                                                    <ins>
                                                        <span class="woocommerce-Price-amount amount">
                                                            <bdi> <span class="woocommerce-Price-currencySymbol">৳
                                                                </span>{{ $item->after_discount }} </bdi>
                                                        </span>
                                                    </ins>
                                                    <del aria-hidden="true">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <bdi> <span class="woocommerce-Price-currencySymbol">৳
                                                                </span>{{ $item->product_price }}</bdi>
                                                        </span>
                                                    </del>
                                                </span>
                                                <div class="add-cart-area">
                                                    <button class="add-to-cart">Add to cart</button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- product quick view modal - start
                                                                    ================================================== -->
                                        <div class="modal fade" id="quickview_popup2{{ $item->id }}"
                                            aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalToggleLabel2">Product
                                                            Quick View</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="product_details">
                                                            <div class="container">
                                                                <div class="row">
                                                                    <div class="col col-lg-6">
                                                                        <div class="product_details_image p-0">
                                                                            <img src="{{ asset('/uploads/products/preview') }}/{{ $item->product_preview }}"
                                                                                alt>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-6">
                                                                        <div class="product_details_content">
                                                                            <h2 class="item_title">
                                                                                {{ $item->product_name }}</h2>
                                                                            <p>
                                                                                {{ $item->short_description }}
                                                                            </p>
                                                                            <div class="item_review">
                                                                                <ul class="rating_star ul_li">
                                                                                    <li><i class="fas fa-star"></i></li>
                                                                                    <li><i class="fas fa-star"></i></li>
                                                                                    <li><i class="fas fa-star"></i></li>
                                                                                    <li><i class="fas fa-star"></i></li>
                                                                                    <li><i class="fas fa-star"></i></li>
                                                                                </ul>
                                                                                <span class="review_value">3
                                                                                    Rating(s)</span>
                                                                            </div>
                                                                            <div class="item_price">
                                                                                <span>TK {{ $item->after_discount }}</span>
                                                                                <del>TK {{ $item->product_price }}</del>
                                                                            </div>
                                                                            <hr>
                                                                            <div class="quantity_wrap">
                                                                                <form action="#">
                                                                                    <div class="quantity_input">
                                                                                        <button type="button"
                                                                                            class="input_number_decrement">
                                                                                            <i class="fal fa-minus"></i>
                                                                                        </button>
                                                                                        <input class="input_number"
                                                                                            type="text" value="1">
                                                                                        <button type="button"
                                                                                            class="input_number_increment">
                                                                                            <i class="fal fa-plus"></i>
                                                                                        </button>
                                                                                    </div>
                                                                                </form>
                                                                                <div class="total_price">
                                                                                    Total: TK {{ $item->after_discount }}
                                                                                </div>
                                                                            </div>

                                                                            <ul class="default_btns_group ul_li">
                                                                                <li><a class="addtocart_btn"
                                                                                        href="{{ route('product.details', $item->id) }}">Add
                                                                                        To Cart</a></li>
                                                                                <li><a href="#!"><i
                                                                                            class="far fa-compress-alt"></i></a>
                                                                                </li>
                                                                                <li><a href="#!"><i
                                                                                            class="fas fa-heart"></i></a>
                                                                                </li>
                                                                            </ul>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- product quick view modal - end
                                                                    ================================================== -->
                                    @endforeach
                                </div>
                            </div>

                            <div class="pagination_wrap">
                                <ul class="pagination_nav">
                                    {{ $products->links('vendor.pagination.bootstrap-4') }}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product_section - end
                                    ================================================== -->
    <form id="fillterForm">
        <input type="hidden" name="sort" id="sort">
    </form>
@endsection
@section('footer_script')
    <script>
        function sortProduct() {
            let sort_by_value = $('#sortby').val();
            $('#sort').val(sort_by_value);
            $('#fillterForm').submit();
        }
    </script>

    <script>
        $('.add_wishlist').click(function() {
            var product_id = $(this).closest('.grid').find('.product_id').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '/add/wishlist',
                data: {
                    'product_id': product_id
                },
            });
        });
    </script>
    @if (session('add_wishlist'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: '{{ session('add_wishlist') }}'
            })
        </script>
    @endif
@endsection
