@extends('layouts.master')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Category</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Add</a></li>
    </ol>
</div>
    <div class="">
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5>Add Category</h5>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                <span>{{session('success')}}</span>
                            </div>
                        @endif
                        <form action="{{url('/category/insert')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="my-1">
                                <label for="category_name" class="my-1">Category Name</label>
                                <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Enter Category Name">
                                @error('category_name')
                                    <span style="color:red">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="my-1">
                                <label for="category_image" class="my-1">Category Image</label>
                                <input type="file" name="category_image" id="category_image" class="form-control" oninput="pic.src=window.URL.createObjectURL(this.files[0])">
                                @error('category_image')
                                    <span style="color:red">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="d-grid col-6 m-auto my-3">
                                <button type="submit" class="btn btn-primary btn-sm">Add Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-shadow-sm">
                    <div class="card-header"><h5>Image Preview</h5></div>
                    <div class="card-body">
                        <img id="pic" class="img-fluid" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_script')
    <script>
        $("#checkAll1").click(function(){
            $('.mark1:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
    <script>
        $("#CheckAll2").click(function(){
            $('.mark2:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endsection