@extends('layouts.master')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Users</a></li>
    </ol>
</div>
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header">Welcome, {{$logged_user_name}}<span class="float-end">Total Users: <strong>{{$total_users_number}}</strong></span></div>

            <div class="card-body">
                @if (session('delete'))
                    <div class="alert alert-success" role="alert">
                        {{ session('delete') }}
                    </div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Zoneing Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($total_users as $key=>$user) 
                            <tr>
                                <td>{{$total_users->firstitem()+$key}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->created_at->format('d-m-y h:i: A')}}</td>
                                <td>
                                    {{-- <a title="Edit" href="" class="btn btn-outline-primary btn-sm"><i class="fa fa-pencil"></i></a> --}}
                                    <a title="Delete" onclick="javascript:return confirm('Are You Sure?')" href="{{route('user.delete', $user->id)}}" class="btn btn-outline-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$total_users->links()}}
            </div>
        </div>
    </div>
</div>
@endsection