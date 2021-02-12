

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
                <div class="row mb-3">
                    <div class="col-6">
                        <label class="col-form-label col-12" for="">Brand</label>
                        <select class="form-control col-12" style="width: 100%" name="product_brand" id="brand" aria-label="Brand">
                            <option>Please Select</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
    
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="" class="col-form-label col-12">Category</label>
                        <select class="form-control col-12" style="width: 100%" name="product_category" id="category" aria-label="Brand">
                            <option>Please Select</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <label for="floatingName" class="col-form-label">Product Name</label>
                        <input type="text" class="form-control" id="product_name" placeholder="Milo Ais">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <label for="floatingDescription" class="col-form-label">Description</label>
                        <textarea class="form-control" placeholder="Milo dari Nesle" id="floatingDescription"  style="height: 100px"></textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <h4>Variasi</h4>
                    </div>
                    <div class="col-6">
                        <label for="" class="col-form-label">Attribute</label>
                        <input type="text" class="form-control" name="attribute[]" id="">
                    </div>
                    <div class="col-6">
                        <label for="" class="col-form-label">Nilai</label>
                        <input type="text" class="form-control" name="value[]" id="">
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6 col-12">
                        <label for="floatingDate">Date Added</label>
                        <input type="datetime-local"" class="form-control" value="yyyy-MM-ddThh:mm" id="floatingDate" placeholder="Date">
                    </div>
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('custom-js')

    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.js"></script>
    <script src="{{ asset('assets/plugins/moment-with-locales.js') }}" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- <script src="{{ asset('assets/js/bootstrap.bundle.js') }}" crossorigin="anonymous"></script> --}}

    <script>
        $('document').ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#brand').select2({
                dropdownParent: $('#addProductModal'),
                placeholder: 'Select an option',
                "ajax": {
                    url: '{{ Route('getBrand') }}',
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results:  $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    },
                }
            });
            $('#category').select2({
                dropdownParent: $('#addProductModal'),
                placeholder: 'Select an option',
                "ajax": {
                    url: '{{ Route('getCategory') }}',
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results:  $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    },
                }
            });
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
                ],
                "columnDefs": [
                    {
                        targets: 5,
                        "render": function ( data, type, row ) {
                            return moment(data).calendar();;
                        },
                    },
                ]
            });
            
        });
    </script>
@endpush