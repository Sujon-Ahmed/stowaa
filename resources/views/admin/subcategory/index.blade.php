@extends('layouts.master')

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Sub-Category</a></li>
    </ol>
</div>
    <div class="">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-header"><h5>Subcategory List</h5></div>
                    <div class="card-body">
                        @if (session('delete'))
                            <div class="alert alert-success" role="alert">{{session('delete')}}</div>
                        @endif
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Category Name</th>
                                    <th>Subcategory Name</th>
                                    <th>Created_at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subcategories as $key=>$subcategory) 
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        @php
                                            if (App\Models\Category::where('id', $subcategory->category_id)->exists()) {
                                                echo $subcategory->rel_to_category->category_name;
                                            } else {
                                                echo "Unknown";
                                            }
                                        @endphp
                                    </td>
                                    <td>{{$subcategory->subcategory_name}}</td>
                                    <td>{{$subcategory->created_at->diffForHumans()}}</td>
                                    <td>
                                        <a title="Edit" href="{{route('subcategory.edit', $subcategory->id)}}" class="btn btn-outline-primary btn-sm"><i class="fa fa-edit"></i></a>
                                        <a onclick="javascript:return confirm('Are You Sure Delete This Subcategory?')" title="Delete" href="{{route('subcategory.delete', $subcategory->id)}}" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection