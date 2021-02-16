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
                        <th>Unit Sales</th>
                        <th>Price Per Unit</th>
                        <th>Total Sales</th>
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

@push('custom-css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('custom-js')
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.js"></script>
    <script src="{{ asset('assets/plugins/moment-with-locales.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/plugins/jquery.repeater.js') }}" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $('document').ready(function(){
            $('#sales_list_table').DataTable();
        })

    </script>
@endpush