@extends('layouts.master')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Sub-Category</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Add</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="text-center">Add SubCategory</h5>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">{{session('success')}}</div>
                @endif
                @if (session('exist'))
                    <div class="alert alert-danger" role="alert">{{session('exist')}}</div>
                @endif
                <form action="{{url('/subcategory/insert')}}" method="POST">
                    @csrf
                    <div class="py-2">
                        <select name="category_id" class="form-control">
                            <option value="" class="text-muted">-- Select Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-danger fw-bold">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="py-2">
                        <label for="subcategory_name" class="my-1">Sub Category Name</label>
                        <input type="text" name="subcategory_name" class="form-control">
                        @error('subcategory_name')
                            <span class="text-danger fw-bold">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="py-2">
                        <button type="submit" class="btn btn-primary btn-sm">Add SubCategory</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection