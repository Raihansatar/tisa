@extends('layouts.main')

@section('content')
    <div class="d-flex justify-content-between">
        <div class="d-flex align-items-end">
            <div class="d-flex pe-2">
                <h1>Sales</h1>
            </div>
            <div class="d-flex ps-2">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">Tedt</li>
                    <li class="breadcrumb-item">Tedt</li>
                </ul>
            </div>
        </div>
    
        <div class="d-flex align-items-center justify-content-between">
            <button class="d-flex align-items-center btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addProductModal">
                <i class="bi bi-plus-square"></i>
                <span>Add Sales</span>
            </button>
        </div>
    
    </div>

    <div class="card card-custom">
        <div class="card-header">
            <div class="card-titlee">Sales List</div>
        </div>
        <div class="card-body">
            <div>
                <table class="table table-hover" id="sales_list_table">
                    <thead class=""">
                        <th>Product Name</th>
                        <th>Sales</th>
                        <th>Unit Sales</th>
                        <th>Price Per Unit</th>
                        <th>Total</th>
                        <th>Sales Date</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    <div/>

@endsection

@push('custom-js')
    
@endpush