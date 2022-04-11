@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-xl-6 col-xxl-12">
        <div class="row">
            <div class="col-sm-6">
                <div class="card avtivity-card">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <span class="activity-icon bgl-success mr-md-4 mr-3">
                                <i style="color: rgb(43, 193, 85)" class="fa fa-users fa-2x text-center"></i>
                            </span>
                            <div class="media-body">
                                <p class="fs-14 mb-2">Total Users</p>
                                <span class="title text-black font-w600">{{ $total_users_number }}</span>
                            </div>
                        </div>
                        <div class="progress" style="height:5px;">
                            <div class="progress-bar bg-success" style="width: 42%; height:5px;" role="progressbar">
                                <span class="sr-only">{{ $total_users_number }}% Complete</span>
                            </div>
                        </div>
                    </div>
                    <div class="effect bg-success"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card avtivity-card">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <span class="activity-icon bgl-secondary  mr-md-4 mr-3">                               
                                <i style="color: blueviolet" class="fa fa-sitemap fa-2x"></i>
                            </span>
                            <div class="media-body">
                                <p class="fs-14 mb-2">Total Category</p>
                                <span class="title text-black font-w600">{{ $total_categories }}</span>
                            </div>
                        </div>
                        <div class="progress" style="height:5px;">
                            <div class="progress-bar bg-secondary" style="width: 82%; height:5px;" role="progressbar">
                                <span class="sr-only">{{ $total_categories }}% Complete</span>
                            </div>
                        </div>
                    </div>
                    <div class="effect bg-secondary"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card avtivity-card">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <span class="activity-icon bgl-danger mr-md-4 mr-3">                               
                                <i style="color: rgb(249, 70, 135)" class="fa fa-shopping-cart fa-2x"></i>
                            </span>
                            <div class="media-body">
                                <p class="fs-14 mb-2">Total Products</p>
                                <span class="title text-black font-w600">{{ $total_products }}</span>
                            </div>
                        </div>
                        <div class="progress" style="height:5px;">
                            <div class="progress-bar bg-danger" style="width: 90%; height:5px;" role="progressbar">
                                <span class="sr-only">{{ $total_products }}% Complete</span>
                            </div>
                        </div>
                    </div>
                    <div class="effect bg-danger"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card avtivity-card">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <span class="activity-icon bgl-warning  mr-md-4 mr-3">
                                <i style="color: rgb(255, 188, 17)" class="fa fa-truck fa-2x"></i>
                            </span>
                            <div class="media-body">
                                <p class="fs-14 mb-2">Total Orders</p>
                                <span class="title text-black font-w600">{{ $total_orders }}</span>
                            </div>
                        </div>
                        <div class="progress" style="height:5px;">
                            <div class="progress-bar bg-warning" style="width: 42%; height:5px;" role="progressbar">
                                <span class="sr-only">{{ $total_orders }}% Complete</span>
                            </div>
                        </div>
                    </div>
                    <div class="effect bg-warning"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
