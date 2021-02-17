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
            <button class="d-flex align-items-center btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addSalesModal">
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

<!-- Modal -->
<div class="modal fade" id="addSalesModal" tabindex="-1" aria-labelledby="addSalesModal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Sales</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="row g-3" id="addSalesForm" action="" method="POST">
            @csrf
            <div class="modal-body">
                <div class="px-4">
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="floatingName" class="col-form-label">Product Name</label>
                            <select class="form-control col-12" style="width: 100%" name="product_name" id="product_name" required>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="" class="col-form-label">Unit Sales</label>
                            <input type="number" class="form-control" name="unit_sales" id="unit_sales" placeholder="">
                        </div>
                        <div class="col-6">
                            <label for="" class="col-form-label">Price per Unit</label>
                            <input type="text" class="form-control" min=00.00 name="price_per_unit" id="price_per_unit" placeholder="" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 col-12">
                            <label for="">Total Sales</label>
                            <input type="text" class="form-control" onchange="setTwoNumberDecimal" min="0.00" max="99999.99" step="0.01" name="total_sales" id="total_sales" placeholder="" required>
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="floatingDate">Sales Date</label>
                            <input type="datetime-local" name="sales_date" class="form-control" value="{{ date('Y-m-d\Th:m') }}" id="floatingDate" placeholder="Date">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Sales</button>
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
            var sales_list_table = $('#sales_list_table').DataTable({
                'responsive': true,
                'serverSide': true,
                'ajax': '{{ Route('sales.index.datatable') }}',
                'columns': [
                    {data: 'product_variant_name', name: 'product_variant_name'},
                    {data: 'unit_sales', name: 'unit_sales'},
                    {data: 'price_per_unit', name: 'price_per_unit'},
                    {data: 'total_sales', name: 'total_sales'},
                    {data: 'date', name: 'date'},
                    {data: 'action', name: 'action'},
                ],
                "columnDefs": [
                    {
                        targets: 4,
                        "render": function ( data, type, row ) {
                            return moment(data).calendar();;
                        },
                    },
                ]
                
            });

            function setTwoNumberDecimal(event) {
                this.value = parseFloat(this.value).toFixed(2);
            }

            $('#product_name').select2({
                dropdownParent: $('#addSalesModal'),
                placeholder: 'Select an option',
                "ajax": {
                    url: '{{ Route('sales.api.getVariantProduct') }}',
                    dataType: 'json',
                    processResults: function (data) {
                        console.log(data)
                        return {
                            results:  $.map(data, function (item) {
                                var text = item.name;
                                JSON.parse(item.variant).forEach(element => {
                                    text = text + " - " + element.value
                                })
                                return {
                                    text: text, 
                                    id: item.id,
                                    custom: item.selling_price_per_unit
                                }
                            })
                        };
                    },
                }
            });
            $('#product_name').change(function(){
                $('#price_per_unit').val($('#product_name').select2('data')[0].custom)
            })

            $('#unit_sales').change(function(){
                $('#total_sales').val( $('#price_per_unit').val() *  $('#unit_sales').val())
            })

            $('#addSalesForm').submit(function(e){
                e.preventDefault();

                var data = $('#addSalesForm').serialize()
                data = data + '&name=' + $('#product_name').select2('data')[0].text
                console.table(data);
                $.ajax({
                    url: '{{ route("sales.api.createSales") }}',
                    dataType: 'JSON',
                    data: data,
                    type: 'POST',
                    success: function(data){
                        sales_list_table.draw()
                        console.log(data)
                    }
                })
            })

        })

    </script>
@endpush