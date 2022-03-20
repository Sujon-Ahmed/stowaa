@extends('layouts.master')

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Products</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5>Edit Product</h5>
            </div>
            <div class="card-body">
                <form action="{{url('/product/update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        {{-- category --}}
                        <div class="col-lg-6">
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="" class="form-control">-- Select Category --</option>
                                @foreach ($all_categories as $category)
                                    <option {{($category->id == $product_info->category_id)?'selected':''}} value="{{$category->id}}" class="form-control">{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- subcategory --}}
                            <div class="col-lg-6">
                                <select name="subcategory_id" id="subcategory_id" class="form-control">
                                    <option value="" class="form-control">-- Select Subcategory --</option>
                                @foreach ($all_subcategories as $subcategory)
                                    <option {{($subcategory->id == $product_info->subcategory_id)?'selected':''}} value="{{$category->id}}" class="form-control">{{$subcategory->subcategory_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- product name --}}
                        <div class="col-lg-6">
                            <label for="product_name" class="form-label mt-2">Product Name</label>
                            <input type="text" name="product_name" value="{{$product_info->product_name}}" class="form-control" id="">
                        </div>
                        {{-- product price --}}
                        <div class="col-lg-6">
                            <label for="product_price" class="form-label mt-2">Product Price</label>
                            <input type="number" name="product_price" value="{{$product_info->product_price}}" class="form-control" id="">
                        </div>
                        {{-- product discount --}}
                        <div class="col-lg-6">
                            <label for="product_discount" class="form-label mt-2">Product Discount</label>
                            <input type="number" name="product_discount" value="{{$product_info->product_discount}}" class="form-control" id="">
                        </div>
                        {{-- quantity --}}
                        <div class="col-lg-6">
                            <label for="quantity" class="form-label mt-2">Quantity</label>
                            <input type="number" name="quantity" value="{{$product_info->quantity}}" class="form-control" id="">
                        </div>
                        {{-- short description --}}
                        <div class="col-lg-12">
                            <label for="short_description" class="form-label mt-2">Short Description</label>
                            <input type="text" name="short_description" value="{{$product_info->short_description}}" class="form-control" id="">
                        </div>
                        {{-- long description --}}
                        <div class="col-lg-12">
                            <label for="long_description" class="form-label mt-2">Long Description</label>
                            <textarea name="long_description" class="form-control" id="" cols="10" rows="5">{{$product_info->long_description}}</textarea>
                        </div>
                        {{-- product preview --}}
                        <div class="col-lg-6">
                            <label for="product_preview" class="form-label mt-2">Product Preview</label>
                            <input type="file" name="product_preview" id="" class="form-control">                            
                        </div>
                        {{-- product thumbnail --}}
                        <div class="col-lg-6">
                            <label for="product_thumbnail" class="form-label mt-2">Product Thumbnail</label>
                            <input type="file" multiple name="product_thumbnail[]" id="" class="form-control">
                        </div>
                        {{-- submit button --}}
                        <div class="col-lg-6 d-grid py-4 mt-3 m-auto">
                            <input type="hidden" name="id" value="{{$product_info->id}}">
                            <button type="submit" class="btn btn-primary btn-block">Update Product</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection