@extends('frontend.master')
@section('content')
<!-- breadcrumb_section - start
================================================== -->
<div class="breadcrumb_section">
    <div class="container">
        <ul class="breadcrumb_nav ul_li">
            <li><a href="index.html">Home</a></li>
            <li>Cart</li>
        </ul>
    </div>
</div>
<!-- breadcrumb_section - end
================================================== -->

<!-- cart_section - start
================================================== -->
<section class="cart_section section_space">
    <div class="container">

        <div class="cart_table">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{url('/cart/update')}}" method="POST">
                        @csrf
                    @php
                        $sub_total = 0;
                    @endphp
                    @forelse ($carts as $cart)
                        <tr>
                            <td>
                                <div class="cart_product">
                                    <img src="{{asset('/uploads/products/preview')}}/{{$cart->rel_to_product->product_preview}}" alt="image_not_found">
                                    <h3><a href="#">{{$cart->rel_to_product->short_description}}</a></h3>
                                </div>
                            </td>
                            <td class="text-center cart_info"> <span class="price_text">{{$cart->rel_to_product->after_discount}}</span></td>
                            <td class="text-center cart_info">           
                                @if ($cart->rel_to_product->quantity > 0) 
                                <div class="quantity_input">
                                    <button type="button" class="input_number_decrement">
                                        <i data-price="{{$cart->rel_to_product->after_discount}}" class="fal fa-minus"></i>
                                    </button>
                                    <input class="input_number8" name="quantity[{{$cart->id}}]" type="text" value="{{$cart->quantity}}" />
                                    <button type="button" class="input_number_increment">
                                        <i data-price="{{$cart->rel_to_product->after_discount}}" class="fal fa-plus"></i>
                                    </button>
                                </div>
                                @php
                                    $sub_total += $cart->rel_to_product->after_discount * $cart->quantity;
                                @endphp             
                                @else
                                <button type="button" class="btn btn-warning btn-sm">Stock Out</button>                                    
                                @endif                                    
                            </td>
                            <td class="text-center cart_info"> <span class="price_text">{{$cart->rel_to_product->after_discount * $cart->quantity}}</span></td>
                            <td class="text-center"><a href="{{route('cart.remove', $cart->id)}}" class="remove_btn"><i class="fal fa-trash-alt"></i></a></td>
                        </tr>                       
                    @empty 
                        <tr>
                            <td colspan="6">
                                <!-- empty_cart_section - start
                                ================================================== -->
                                <section class="empty_cart_section section_space">
                                    <div class="container">
                                        <div class="empty_cart_content text-center">
                                            <span class="cart_icon">
                                                <i class="icon icon-ShoppingCart"></i>
                                            </span>
                                            <h3>There are no more items in your cart</h3>
                                            <a class="btn btn_secondary" href="{{url('/shop/grid')}}"><i class="far fa-chevron-left"></i> Continue shopping </a>
                                        </div>
                                    </div>
                                </section>
                                <!-- empty_cart_section - end
                                ================================================== -->
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="cart_btns_wrap">
            <div class="row">
                <div class="col col-lg-6">
                    <ul class="btns_group ul_li_right float-start">
                        <li><button type="submit" class="btn border_black">Update Cart</button></li>
                        @php
                            session([
                                'discount'=>$discount,        
                            ]);
                        @endphp
                        <li><a class="btn btn_dark" href="{{route('checkout')}}">Prceed To Checkout</a></li>
                    </ul>
                </div>
            </form>
                <div class="col col-lg-6">
                    <form action="{{ url('/cart') }}" method="GET">
                        <div class="coupon_form form_item mb-0">
                            <input type="text" name="coupon_code" value="{{ $coupon_code }}" autocomplete="off" placeholder="Coupon Code...">
                            <button type="submit" class="btn btn_dark">Apply Coupon</button>
                            <div class="info_icon">
                                <i class="fas fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Your Info Here"></i>
                            </div>
                        </div>
                        @if ($message)
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            {{-- <div class="col col-lg-6">
                <div class="calculate_shipping">
                    <h3 class="wrap_title">Calculate Shipping <span class="icon"><i class="far fa-arrow-up"></i></span></h3>
                    <form action="#">
                        <div class="select_option clearfix">
                            <select class="delivery_location">
                                <option value="">Select Your Option</option>
                                <option value="1">Inside City</option>
                                <option value="2">Outside City</option>
                            </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn_primary rounded-pill">Update Total</button>
                    </form>
                </div>
            </div> --}}

            <div class="col col-lg-12">
                <div class="cart_total_table">
                    <h3 class="wrap_title">Cart Totals</h3>
                    <ul class="ul_li_block">
                        <li>
                            <span>Cart Subtotal</span>
                            <span>{{ $sub_total }}</span>
                        </li>
                        <li>
                            <span>Discount</span>
                            <span>{{ $discount }}</span>
                        </li>
                        <li>
                            <span>Order Total</span>
                            <span class="total_price">{{ $sub_total - ($sub_total * $discount) / 100 }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- cart_section - end
================================================== -->
@endsection
@section('footer_script')
<script>
    let quantity_input = document.querySelectorAll('.cart_info')
    let arr = Array.from(quantity_input)

    arr.map(item=>{
        item.addEventListener('click', function(e) {
            if (e.target.className == 'fal fa-plus') {
                e.target.parentElement.previousElementSibling.value++
                var qty = e.target.parentElement.previousElementSibling.value
                let price = e.target.dataset.price
                item.nextElementSibling.innerHTML = price * qty
            }
            if (e.target.className == 'fal fa-minus') {
                if ( e.target.parentElement.nextElementSibling.value > 1) {
                    e.target.parentElement.nextElementSibling.value--
                    var qty = e.target.parentElement.nextElementSibling.value
                    let price = e.target.dataset.price
                    item.nextElementSibling.innerHTML = price * qty
                }
            }
        })
    })
</script>
@endsection