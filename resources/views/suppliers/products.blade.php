@extends('layouts.master')
@section('title')
    Supplier products
@endsection
@section('content')
    <!-- header & breadcrumbs  -->
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('suppliers')}}">Suppliers</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Supplier Products</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <a class="btn btn-primary" href="#add" data-target="#add" data-toggle="modal" role="button">
                    Add
                </a>
            </div>
        </div>
    </div>
    <!-- header & breadcrumbs  -->
    <!-- content card -->
    @php
        $array = ['supplier_id'=>$id, 'name'=>$name];
    @endphp
        <supplier-products-component :supplierdetails="{{ json_encode($array)}}"/>
    <!-- ./end content card -->
    
@endsection
