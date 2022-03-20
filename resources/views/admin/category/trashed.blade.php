@extends('layouts.master')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Category</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Trashed</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm mt-4">
            <div class="card-header">
                <h5>Trashed Category List </h5>
            </div>
            <div class="card-body">
                <form action="{{url('/trashed/category/restore/delete')}}" method="POST">
                    @csrf
                    <table class="table table-bordered">
                        @if (session('permanent_delete'))
                            <div class="alert alert-success" role="alert">
                                <span>{{session('permanent_delete')}}</span>
                            </div>
                        @endif
                        @if (session('empty2'))
                            <div class="alert alert-danger" role="alert">
                                <span>{{session('empty2')}}</span>
                            </div>
                        @endif
                        @if (session('success_update'))
                            <div class="alert alert-success" role="alert">
                                <span>{{session('success_update')}}</span>
                            </div>
                        @endif
                        <thead>
                            <tr>
                                <th><input type="checkbox" name="CheckAll2" id="CheckAll2"> Mark</th>
                                <th>SL</th>
                                <th>Category Name</th>
                                <th>Photo</th>
                                <th>Added_by</th>
                                <th>Created_at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($trashed_categories as $key=>$category)       
                            <tr>
                                <td><input type="checkbox" class="mark2" name="mark2[]" id="mark2" value="{{$category->id}}"></td>
                                <td>{{$key+1}}</td>
                                <td>{{$category->category_name}}</td>
                                <td><img src="{{asset('uploads/categories/'.$category->category_image)}}" width="100" alt=""></td>
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
                                    <a title="Restore" href="{{route('category.restore', $category->id)}}" class="btn btn-outline-primary btn-sm"><i class="fa fa-undo"></i></a>
                                    <a onclick="javascript:return confirm('Are you sure permanently delete this category?')" title="Permanent Delete" href="{{route('category.hard.delete', $category->id)}}" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No data available in table</td>
                            </tr>
                            @endforelse     
                        </tbody>
                    </table>
                    <button type="submit" name="btn" value="1" class="btn btn-primary btn-sm">Restore All</button>
                    <button type="submit" name="btn" value="0" class="btn btn-danger btn-sm">Delete All</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_script')
    <script>
        $("#CheckAll2").click(function(){
            $('.mark2:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endsection