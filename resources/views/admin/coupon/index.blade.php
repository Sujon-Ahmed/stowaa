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
                            <th>Code</th>
                            <th>Discount</th>
                            <th>Validity</th>
                            <th>Created_at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coupons as $key=>$item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item->coupon_code}}</td>
                            <td>{{$item->discount}}</td>
                            <td>{{$item->validity}}</td>
                            <td>{{$item->created_at->diffForHumans()}}</td>
                            <td>
                                <a onclick="javascript:return confirm('are you sure delete this coupon?')" href="{{url('/coupon/delete', $item->id)}}" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></a>
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
               <h5>Add Coupon</h5>
           </div>
           <div class="card-body">
                <form action="{{ url('admin/coupon/insert') }}" method="POST">
                    @csrf
                    <div class="mb-2">
                        <label for="coupon_code" class="mb-1 form-label">Coupon Code</label>
                        <input type="text" name="coupon_code" id="coupon_code" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label for="discount" class="mb-1 form-label">Discount</label>
                        <input type="text" name="discount" id="discount" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label for="validity" class="mb-1 form-label">Validity</label>
                        <input type="date" name="validity" id="validity" class="form-control">
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