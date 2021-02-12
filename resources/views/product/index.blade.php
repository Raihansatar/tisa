

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
        <button class="d-flex align-items-center btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addProductModal">
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
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="row g-3">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingName" placeholder="Milo Ais">
                    <label for="floatingName">Product Name</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Milo dari Nesle" id="floatingDescription"  style="height: 100px"></textarea>
                    <label for="floatingDescription">Description</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" name="product_brand" id="floatingBrand" aria-label="Brand">
                        <option selected>Please Select</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach

                    </select>
                    <label for="floatingBrand">Brand</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" name="product_category" id="floatingCategory" aria-label="Brand">
                        <option selected>Please Select</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <label for="floatingCategory">Category</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="datetime-local"" class="form-control" value="YYYY-MM-DD" id="floatingDate" placeholder="Date">
                    <label for="floatingDate">Date Added</label>
                </div>
            </form>
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