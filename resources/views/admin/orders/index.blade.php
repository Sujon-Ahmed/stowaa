@extends('layouts.master')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Orders</a></li>
    </ol>
</div>
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header">Orders information</div>

            <div class="card-body">
                @if (session('delete'))
                    <div class="alert alert-success" role="alert">
                        {{ session('delete') }}
                    </div>
                @endif
                <table id="example3" class="display min-w850">
                    <thead>
                        <tr>
                            <th>order_id</th>
                            <th>customer</th>
                            <th>amount</th>
                            <th>phone</th>
                            <th>email</th>
                            <th>options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)                            
                        <tr>
                           <td>{{ $order->id }}</td>
                            <td>{{ $order->rel_to_orderDetails->name }}</td>
                            <td>{{ $order->sub_total }}</td>
                            <td>{{ $order->rel_to_orderDetails->phone }}</td>
                            <td>{{ $order->rel_to_orderDetails->email }}</td>
                            <td>
                                <a href="{{ route('invoice.download', $order->id) }}" title="Download invoice" class="btn btn-outline-success btn-sm"><i class="fa fa-download"></i></a>
                                <a href="{{ route('order.delete', $order->id) }}" class="btn btn-outline-danger btn-sm" title="Order Delete"><i class="fa fa-trash"></i></a>
                            </td> 
                        </tr>
                        @endforeach
                    </tbody>
                    <tbody>
                        
                    </tbody>
                </table>
               
            </div>
        </div>
    </div>
</div>
@endsection