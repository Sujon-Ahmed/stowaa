@extends('frontend.master')
@section('content')
<!-- breadcrumb_section - start
================================================== -->
<div class="breadcrumb_section">
    <div class="container">
        <ul class="breadcrumb_nav ul_li">
            <li><a href="{{url('/')}}">Home</a></li>
            <li>Order Confirm</li>
        </ul>
    </div>
</div>
<!-- breadcrumb_section - end
================================================== -->
<div class="container mt-5 py-5">
    <div class="row">
        <div class="col-lg-10 m-auto">
            <div class="alert alert-success py-5">
                <h4 class="text-center text-capitalize">{{session('ordered_confirm')}}</h4>
            </div>
        </div>
    </div>
</div>

@endsection