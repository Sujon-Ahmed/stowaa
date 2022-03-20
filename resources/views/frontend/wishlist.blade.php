@extends('frontend.master')
@section('content')
<!-- breadcrumb_section - start
================================================== -->
<div class="breadcrumb_section">
    <div class="container">
        <ul class="breadcrumb_nav ul_li">
            <li><a href="index.html">Home</a></li>
            <li>Wishlist</li>
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
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>PRODUCT</th>
                        <th class="text-center">PRICE</th>
                        <th class="text-center">STOCK STATUS</th>
                        <th class="text-center">ADD TO CART</th>
                        <th class="text-center">REMOVE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wishlist as $item)
                    <tr class="product_data">
                        <td>
                            <div class="cart_product">
                                <img src="{{asset('/uploads/products/preview')}}/{{$item->rel_to_product->product_preview}}" alt="image_not_found" />
                                <h3>{{$item->rel_to_product->short_description}}</h3>
                            </div>
                        </td>
                        <td class="text-center"><span class="price_text">৳ {{$item->rel_to_product->after_discount}}</span></td>
                        <td class="text-center">
                            @if ($item->rel_to_product->quantity <= 0)                                
                                <span class="price_text text-danger">Out Stock</span>
                            @else
                                <span class="price_text text-success">In Stock</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($item->rel_to_product->quantity > 0)                                                                                                  
                            <a href="{{url('/product/details',$item->rel_to_product->id)}}" name="product_id" class="btn btn_primary add_to_cart">Add To Cart</a>                               
                            @endif
                        </td>
                        <td class="text-center">
                            <input type="hidden" name="id" class="product_id" value="{{$item->id}}">
                            <button type="button" class="remove_btn"><i class="fal fa-trash-alt"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- cart_section - end
================================================== -->
@endsection
@section('footer_script')
    <script>
        $('.remove_btn').click(function() {
            var product_id = $(this).closest('.product_data').find('.product_id').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:"POST",
                url:"/remove/wishlist/product",
                data:{
                    'product_id':product_id
                },
                success:function(success) {
                    window.location.reload();
                }
            });
        });
    </script>
@endsection