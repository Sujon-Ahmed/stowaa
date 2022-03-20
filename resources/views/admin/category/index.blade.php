@extends('layouts.master')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Category</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">View</a></li>
    </ol>
</div>
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Category List</h5>
                        <small class="float-end">Total Categories : <strong>{{$total_categories}}</strong></small>
                    </div>
                    <div class="card-body">
                        <form action="{{url('/category/mark/delete')}}" method="POST">
                            @csrf
                            <table class="table table-bordered">
                                @if (session('soft_delete'))
                                    <div class="alert alert-success" role="alert">
                                        <span>{{session('soft_delete')}}</span>
                                    </div>
                                @endif
                                @if (session('category_update'))
                                    <div class="alert alert-success" role="alert">
                                        <span>{{session('category_update')}}</span>
                                    </div>
                                @endif
                                @if (session('empty'))
                                    <div class="alert alert-danger" role="alert">
                                        <span>{{session('empty')}}</span>
                                    </div>
                                @endif
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" name="checkAll1" id="checkAll1"> Mark</th>
                                        <th>SL</th>
                                        <th>Category Name</th>
                                        <th>Photo</th>
                                        <th>Added_by</th>
                                        <th>Created_at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $key=>$category)       
                                    <tr>
                                        <td><input type="checkbox" class="mark1" name="mark1[]" id="mark1" value="{{$category->id}}"></td>
                                        <td>{{$key+1}}</td>
                                        <td>{{$category->category_name}}</td>
                                        <td><img src="{{asset('uploads/categories/'.$category->category_image)}}" class="img-fluid" width="100" alt=""></td>
                                        <td>
                                            @php
                                                if (App\Models\User::where('id', $category->added_by)->exists()) {
                                                    echo $category->rel_to_user->name;
                                                } else {
                                                    echo 'N/A';
                                                }
                                            @endphp
                                        </td>
                                        <td>{{$category->created_at->diffForHumans()}}</td>
                                        <td class="text-center">
                                            <a title="Edit" href="{{route('category.edit', $category->id)}}" class="btn btn-outline-primary btn-sm"><i class="fa fa-edit"></i></a>
                                            <a onclick="javascript:return confirm('Are you sure delete this category?')" title="Soft Delete" href="{{route('category.soft.delete', $category->id)}}" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">No data available in table</td>
                                    </tr>
                                    @endforelse      
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-danger btn-sm">Delete All</button>
                        </form>
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
@endsection