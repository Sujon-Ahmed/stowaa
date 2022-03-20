@extends('layouts.master')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Products</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">View</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5>Product Lists</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>After Discount</th>
                            <th>Quantity</th>
                            <th>Preview</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_products as $key=>$product)  
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                @if (App\Models\Category::where('id', $product->category_id)->exists())
                                    {{$product->rel_to_categories->category_name}}
                                    @else
                                    {{"N/A"}}
                                @endif
                            </td>
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->product_price}}</td>
                            <td>{{($product->product_discount == '' ? '-':$product->product_discount)}}</td>
                            <td>{{$product->after_discount}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>
                                <img width="50" src="{{asset('/uploads/products/preview')}}/{{$product->product_preview}}" alt="">
                            </td>
                            <td>
                                <a href="{{route('product.edit',$product->id)}}" class="btn btn-outline-success btn-sm"><i class="fa fa-edit"></i></a>
                                <a onclick="javascript:return confirm('Are you sure delete this product?')" href="{{route('product.delete',$product->id)}}" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection