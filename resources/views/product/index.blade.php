

@extends('layouts.main')

@section('content')


<div class="d-flex justify-content-between">
    <div class="d-flex align-items-end">
        <div class="d-flex pe-2">
            <h1>Product</h1>
        </div>
        <div class="d-flex ps-2">
            <ul class="breadcrumb">
                <li class="breadcrumb-item">Tedt</li>
                <li class="breadcrumb-item">Tedt</li>
                <li class="breadcrumb-item">Tedt</li>
            </ul>
        </div>
    </div>

    <div class="d-flex align-items-center">
        <button class="d-flex align-items-center btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="bi bi-plus-square"></i>
            <span>Add</span>
        </button>
    </div>

</div>


<div class="card card-custom">
    <div class="card-header">
        <div class="card-titlee">Product List</div>
    </div>
    <div class="card-body">
        <div>
            <table class="table table-hover" id="product_list_table">
                <thead class=""">
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Buying Price</th>
                    <th>Selling Price</th>
                    <th>Stock</th>
                    <th>Buying Date</th>
                    <th>Action</th>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
<div/>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

@endsection

@push('custom-css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.css"/>
@endpush

@push('custom-js')
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.js"></script>
    <script>
        $('document').ready(function(){
            $('#product_list_table').DataTable({
                "responsive": true,
                "serverSide": true,
                "ajax": "{{ route('product.index.datatable') }}",
                "columns": [
                    {data: 'product_name', name: 'product_name'},
                    {data: 'category', name: 'category'},
                    {data: 'buying_price', name: 'buying_price'},
                    {data: 'selling_price_per_unit', name: 'selling_price_per_unit'},
                    {data: 'stock', name: 'stock'},
                    {data: 'buying_date', name: 'buying_date'},
                    {data: 'action', name: 'action'},
                ]
            });
            
        });
    </script>
@endpush