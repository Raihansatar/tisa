

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
        <form class="row g-3" id="addProductForm" action="{{ Route('product.create') }}" method="POST">
            @csrf
            <div class="modal-body">
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
                        <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Milo Ais">
                    </div>
                </div>
                <div class="col-12">
                    <h4>Variasi</h4>
                </div>
                <div id="variasiRepeater">
                    <span data-repeater-list="">
                        <div class="row mb-3" data-repeater-item>
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Attribute</label>
                                <input type="text" class="form-control" name="attribute">
                            </div>
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Nilai</label>
                                <input type="text" class="form-control nilai" name="value">
                            </div>
                            {{-- <div class="col-md-4 d-flex align-bottom" style="background-color: red"> --}}
                            <div class="col-md-4">
                                {{-- <div class="col-12"></div> --}}
                                <label for="" class="col-form-label">Delete</label>
                                <div class="col-12">
                                    <button type="button" data-repeater-delete="" class="btn btn-sm btn-danger">
                                        Delete
                                    </button>

                                </div>
                            </div>
                        </div>
                    </span>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <a href="javascript:;" data-repeater-create="" class="btn btn-sm btn-primary">
                                <i class="la la-plus"></i>Add
                            </a>
                        </div>
                    </div>

                </div>

                <div>Fullname = <span id="product_full_name"></span></div>
                <div class="col-12">
                    <h4>Details</h4>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <label for="floatingDescription" class="col-form-label">Description</label>
                        <textarea class="form-control" placeholder="Milo dari Nesle" id="floatingDescription" name="description" style="height: 100px"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="" class="col-form-label">Buying Price</label>
                        <input type="text" class="form-control" min="00.00" name="product_buying_price" id="product_buying_price" placeholder="10.00">
                    </div>
                    <div class="col-6">
                        <label for="" class="col-form-label">Selling Price per Unit</label>
                        <input type="text" class="form-control" min=00.00 name="product_selling_price" id="product_selling_price" placeholder="10.00">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 col-12">
                        <label for="">Stock</label>
                        <input type="number" name="stock" class="form-control" value="yyyy-MM-ddThh:mm" id="stock" placeholder="">
                    </div>
                    <div class="col-md-6 col-12">
                        <label for="floatingDate">Date Added</label>
                        <input type="datetime-local" name="date_added" class="form-control" value="yyyy-MM-ddThh:mm" id="floatingDate" placeholder="Date">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        
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
    <script src="{{ asset('assets/plugins/jquery.repeater.js') }}" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $('document').ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#product_name').change(function(){
                $('document').ready(function(){
                    var fullname = ""
                    $(".nilai").each(function(){
                        fullname = fullname + " - " +  $( this ).val();
                    })
                    
                    // console.log(fullname)
                    $('#product_full_name').html($('#product_name').val() + fullname);
                })
            });

            $('#addProductForm').submit(function(e){
                e.preventDefault();
                var data = $("#addProductForm").serializeArray()
                console.table(data)
            });



            $('#variasiRepeater').repeater({
                initEmpty: true,

                // defaultValues: {
                //     'value': '',
                // },

                show: function (){

                    $(".nilai").change(function() {

                        var fullname = ""
                        $(".nilai").each(function(){
                            fullname = fullname + " - " +  $( this ).val();
                        })
                        
                        $('#product_full_name').html($('#product_name').val() + fullname);


                    });

                    $(this).slideDown();
                    
                },

                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                    $('document').ready(function(){
                        $(".nilai").change(function() {
    
                            var fullname = ""
                            $(".nilai").each(function(){
                                fullname = fullname + " - " +  $( this ).val();
                            })
        
                            $('#product_full_name').html($('#product_name').val() + fullname);
    
                        });
                    })
                },then: function(){
                    alert("aweawe")
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