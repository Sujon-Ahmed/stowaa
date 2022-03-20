@extends('layouts.master')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Category</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit</a></li>
    </ol>
</div>
    <div class="">
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header text-center">
                        <h5>Edit Category</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{url('/category/update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="my-1">
                                <label for="category_name" class="mb-1">Category Name</label>
                                <input type="text" name="category_name" value="{{$category_info->category_name}}" id="category_name" class="form-control">
                            </div>
                            <div class="my-1">
                                <label for="category_image" class="mb-1">Category Image</label>
                                <input type="file" name="category_image" id="category_image" class="form-control" oninput="pic.src=window.URL.createObjectURL(this.files[0])">
                            </div>
                            <div class="d-grid col-6 m-auto py-2">
                                <input type="hidden" name="id" value="{{$category_info->id}}" id="id">
                                <button type="submit" class="btn btn-success btn-sm">Update Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-shadow-sm">
                    <div class="card-header"><h5>Image Preview</h5></div>
                    <div class="card-body">
                        <img src="{{asset('uploads/categories/'.$category_info->category_image)}}" id="pic" class="img-fluid" />
                    </div>
                </div>
            </div>
        </div>
    </div
@endsection