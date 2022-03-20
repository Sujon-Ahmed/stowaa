@extends('layouts.master')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Coupon</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-lg-8 py-3">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5>Coupon List</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Location</th>
                            <th>Charge</th>
                            <th>Created_at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($charges as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->delivery_location}}</td>
                            <td>{{$item->delivery_charge}}</td>
                            <td>{{$item->created_at->diffForHumans()}}</td>
                            <td>
                                <a href="" class="btn btn-success btn-sm">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4 py-3">
        <div class="card shadow-sm">
           <div class="card-header">
               <h5>Add Charge</h5>
           </div>
           <div class="card-body">
                <form action="{{ url('/delivery/charge/insert') }}" method="POST">
                    @csrf
                    <div class="mb-2">
                        <label for="location" class="mb-1 form-label">Location</label>
                        <input type="text" name="location" id="location" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label for="charge" class="mb-1 form-label">Charge</label>
                        <input type="text" name="charge" id="charge" class="form-control">
                    </div>
                    <div class="mb-2 mt-3">
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </div>
                </form>
           </div>
        </div>
    </div>
</div>
@endsection