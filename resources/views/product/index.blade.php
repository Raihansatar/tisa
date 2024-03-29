

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

    <div class="d-flex align-items-center justify-content-between">
        <div class="pe-4">
            <button class="d-flex align-items-center btn btn-sm btn-primary" data-toggle="modal" data-target="#addVariantModal">
                <i class="bi bi-plus-square"></i>
                <span>Add Variant</span>
            </button>
        </div>

        <button class="d-flex align-items-center btn btn-sm btn-success" data-toggle="modal" data-target="#addProductModal">
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
<div class="modal fade" id="addVariantModal" tabindex="-1" aria-labelledby="addVariantModal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Variant</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="row g-3" id="addVariantForm" action="" method="POST">
            @csrf
            <div class="modal-body">
                <div class="px-4">
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="product_variant_name" class="col-form-label">Product Name</label>
                            <select class="form-control col-12" style="width: 100%" name="product_variant_name" id="product_variant_name" aria-label="Brand" required>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="col-form-label col-12" for="">Brand</label>
                            <select class="form-control col-12" style="width: 100%" name="product_variant_brand" id="product_variant_brand" aria-label="Brand" disabled>
                                <option value="" id="product_variant_brand_option"></option>
                            </select>
                        </div>
    
                        <div class="col-6">
                            <label for="" class="col-form-label col-12">Category</label>
                            <select class="form-control col-12" style="width: 100%" name="product_variant_category" id="product_variant_category" aria-label="Brand" required disabled>
                                <option value="" id="product_variant_category_option"></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <h4>Variasi</h4>
                    </div>
                    <pre id="available_variant"></pre>
                    <div id="variasiOnlyRepeater">
                        <span data-repeater-list="">
                            <div class="row mb-3" data-repeater-item>
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Attribute</label>
                                    <input type="text" class="form-control" name="attribute" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Nilai</label>
                                    <input type="text" class="form-control" name="value" required>
                                </div>
                                <div class="col-md-4">
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

                    <div class="col-12">
                        <h4>Details</h4>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="product_variant_description" class="col-form-label">Description</label>
                            <textarea class="form-control" placeholder="Milo dari Nesle" id="product_variant_description" name="product_variant_description" style="height: 100px"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="" class="col-form-label">Buying Price</label>
                            <input type="text" class="form-control" min="00.00" name="product_variant_buying_price" id="product_variant_buying_price" placeholder="10.00">
                        </div>
                        <div class="col-6">
                            <label for="" class="col-form-label">Selling Price per Unit</label>
                            <input type="text" class="form-control" min=00.00 name="product_variant_selling_price" id="product_variant_selling_price" placeholder="10.00" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 col-12">
                            <label for="">Stock</label>
                            <input type="number" name="product_variant_stock" class="form-control" id="product_variant_stock" placeholder="" required>
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="product_variant_date">Date Added</label>
                            <input type="datetime-local" name="product_variant_date_added" class="form-control" value="" id="product_variant_date" placeholder="Date">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="row g-3" id="addProductForm" action="{{ Route('product.create') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="px-4">

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
                            <select class="form-control col-12" style="width: 100%" name="product_category" id="category" aria-label="Brand" required>
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
                            <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Milo Ais" required>
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
                                    <input type="text" class="form-control" name="attribute" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Nilai</label>
                                    <input type="text" class="form-control nilai" name="value" required>
                                </div>
                                <div class="col-md-4">
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
                            <textarea class="form-control" placeholder="Milo dari Nesle" id="floatingDescription" name="product_description" style="height: 100px"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="" class="col-form-label">Buying Price</label>
                            <input type="text" class="form-control" min="00.00" name="product_buying_price" id="product_buying_price" placeholder="10.00">
                        </div>
                        <div class="col-6">
                            <label for="" class="col-form-label">Selling Price per Unit</label>
                            <input type="text" class="form-control" min=00.00 name="product_selling_price" id="product_selling_price" placeholder="10.00" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 col-12">
                            <label for="">Stock</label>
                            <input type="number" name="product_stock" class="form-control" id="stock" placeholder="" required>
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="floatingDate">Date Added</label>
                            <input type="datetime-local" name="product_date_added" class="form-control" value="yyyy-MM-ddThh:mm" id="floatingDate" placeholder="Date">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" >Submit</button>
            </div>
        </form>
        
      </div>
    </div>
</div>

@endsection

@push('custom-css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('custom-js')

    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment-with-locales.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/plugins/jquery.repeater.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/select2.js') }}"></script>

    <script>
        $('document').ready(function(){
            var table = $('#product_list_table').DataTable({
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
                    
                    $('#product_full_name').html($('#product_name').val() + fullname);
                })
            });

            $('#addProductForm').submit(function(e){
                e.preventDefault();
                var formData = new FormData();

                formData.append('product_name', $('input[name=product_name]').val());
                formData.append('product_description', $('textarea[name=product_description]').val());
                formData.append('product_brand', $('select[name=product_brand]').val());
                formData.append('product_category', $('select[name=product_category]').val());
                formData.append('product_variasi', (($('#variasiRepeater').repeaterVal()[""] == null)? "null" : JSON.stringify($('#variasiRepeater').repeaterVal()[""])));
                formData.append('product_buying_price', $('input[name=product_buying_price]').val());
                formData.append('product_selling_price', $('input[name=product_selling_price]').val());
                formData.append('product_date_added', $('input[name=product_date_added]').val());
                formData.append('product_stock', $('input[name=product_stock]').val()); 

                $.ajax({
                    url: "{{ route('product.createProduct') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    dataType: "JSON",
                    success: function(data){
                        console.log(data)
                        table.draw();
                    }
                })

            });

            $('#variasiRepeater').repeater({
                initEmpty: false,
                isFirstItemUndeletable: true,
                defaultValues: {
                    'text-input': 'foo'
                },
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

            //* Product variant add
            $('#variasiOnlyRepeater').repeater({
                initEmpty: true,

                show: function (){

                    $(this).slideDown();
                    
                },

                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });

            $('#addVariantForm').submit(function(e){
                e.preventDefault();
                var formVariantData = new FormData();

                formVariantData.append('product_id', $('select[name=product_variant_name]').val());
                formVariantData.append('product_variant_variasi', (($('#variasiOnlyRepeater').repeaterVal()[""] == null)? "null" : JSON.stringify($('#variasiOnlyRepeater').repeaterVal()[""])));
                formVariantData.append('product_variant_buying_price', $('input[name=product_variant_buying_price]').val());
                formVariantData.append('product_variant_selling_price', $('input[name=product_variant_selling_price]').val());
                formVariantData.append('product_variant_date_added', $('input[name=product_variant_date_added]').val());
                formVariantData.append('product_variant_stock', $('input[name=product_variant_stock]').val()); 

                $.ajax({
                    url: "{{ route('product.addVariant') }}",
                    data: formVariantData,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    dataType: "JSON",
                    success: function(data){
                        console.log(data)
                        table.draw();
                        showVariant()
                    }
                })

            });
            
            function showVariant(){
                $.ajax({
                    url: '{{ Route('product.api.getProductVariant') }}',
                    data: {
                        id:  $('#product_variant_name').val()
                    },
                    // available_variant
                    dataType: 'json',
                    success: function(data){
                        $('#available_variant').html('')
                        if(data!=null){
                            var num = 1;
                            data.forEach((element) => {
                                $('#available_variant').append(num + '.  ' )
                                JSON.parse(element.variant).forEach(element => {
                                    $('#available_variant').append(element.attribute + " : " + element.value + ". &nbsp; &nbsp;&nbsp; ")
                                })
                                $('#available_variant').append('<br>')
                                num++;
                            });
                        }else{
                            $('#available_variant').append('No Variant')
                        }
                    }
                })
            }

                

            $('#product_variant_name').change(function(){
                $.ajax({
                    url: '{{ Route('product.api.getProductDetails') }}',
                    data: {
                        id:  $('#product_variant_name').val()
                    },
                    // available_variant
                    dataType: 'json',
                    success: function(data){

                        // console.log(data)
                        if(data.brand != null){
                            $('#product_variant_brand_option').html(data.brand.name);
                            $('#product_variant_brand_option').val(data.brand.id);
                        }else{
                            $('#product_variant_brand_option').html('');
                            $('#product_variant_brand_option').val('');
                        }
                        if(data.category != null){
                            $('#product_variant_category_option').html(data.category.name);
                            $('#product_variant_category_option').val(data.category.id);
                        }
                        
                        showVariant();
                        
                    },
                })
                
            })
            

            $('#product_variant_name').select2({
                dropdownParent: $('#addVariantModal'),
                placeholder: 'Select an option',
                "ajax": {
                    url: '{{ Route('product.api.getProduct') }}',
                    dataType: 'json',
                    processResults: function (data) {
                        console.log(data)
                        return {
                            results:  $.map(data, function (item) {
                                return {
                                    text: item.name + " - " + ( (item.brand != null)?  item.brand.name : "No Brand" ) ,
                                    id: item.id
                                }
                            })
                        };
                    },
                }
            });


        });
    </script>
@endpush