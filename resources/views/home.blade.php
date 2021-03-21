@extends('layouts.master')
@section('title')
    User
@endsection
@section('content')
    <!-- stats row -->
    <div class="row">
        <div class="col-xl-4 mb-30">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="progress-data">
                        <span style="font-size: 72px;opacity:0.8;" class="text-danger micon icon-copy icon-copy ti-layout-grid3"></span>
                    </div>
                    <div class="widget-data">
                        <div class="h4 mb-0">{{ $products }}</div>
                        <div class="weight-600 font-14">Products</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 mb-30">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="progress-data">
                        <span style="opacity:0.8;" class="text-info micon fa fa-users fa-5x"></span>
                    </div>
                    <div class="widget-data">
                    <div class="h4 mb-0"> {{ $suppliers }}</div>
                        <div class="weight-600 font-14">Suppliers</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 mb-30">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="progress-data">
                        <span style="font-size: 72px;opacity:0.8;" class="text-success micon icon-copy ti-shopping-cart-full">
                    </div>
                    <div class="widget-data">
                        <div class="h4 mb-0">{{ $orders }}</div>
                        <div class="weight-600 font-14">Orders</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ./end stats row -->

    <!-- charts row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center">
                    <main-chart-component/>
                </div>
            </div>
        </div>
    </div>
    <!-- ./end charts row -->
@endsection
