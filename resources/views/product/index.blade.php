

@extends('layouts.main')

@section('content')

<div class="card card-custom">
    <div class="card-header">
        <div class="card-titlee">Product List</div>
    </div>
    <div class="card-body">
        <div>
            <table class="table table-hover" id="product_list_table">
                <thead class="table-primary"">
                    <th>Product Name</th>
                    <th>Buying Price</th>
                    <th>Selling Price</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Nasi Ayam</td>
                        <td>RM 325253.325</td>
                        <td>RMwerwer.werw</td>
                        <td>Icon action sisni kei</td>
                    </tr>
                    <tr>
                        <td>Nasi Ayam</td>
                        <td>RM 325253.325</td>
                        <td>RMwerwer.werw</td>
                        <td>Icon action sisni kei</td>
                    </tr>
                    <tr>
                        <td>Nasi Ayam</td>
                        <td>RM 325253.325</td>
                        <td>RMwerwer.werw</td>
                        <td>Icon action sisni kei</td>
                    </tr>
                    <tr>
                        <td>Nasi Ayam</td>
                        <td>RM 325253.325</td>
                        <td>RMwerwer.werw</td>
                        <td>Icon action sisni kei</td>
                    </tr>
                    <tr>
                        <td>Nasi Ayam</td>
                        <td>TM 325253.325</td>
                        <td>RMwerwer.werw</td>
                        <td>Icon action sisni kei</td>
                    </tr>
                    <tr>
                        <td>Nasi Ayam</td>
                        <td>RM 325253.325</td>
                        <td>RMwerwer.werw</td>
                        <td>Icon action sisni kei</td>
                    </tr>
                </tbody>
            </table>
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
                // "responsive": true,
                // "serverSide": true,
                // "ajax": "route('dropship.product.index') ",
                // "columns": [
                //     {data: 'dropship_id', name: 'dropship_id'},
                //     {data: 'product_id', name: 'product_id'},
                //     {data: 'status', name: 'status'},
                //     {data: 'request_date', name: 'request_date'},
                //     {data: 'respond_date', name: 'respond_date'},
                //     {data: 'created_at', name: 'created_at'},
                // ]
            });

            // $('#dropship-product-super').DataTable({
            //     "responsive": true,
                
            // });
            
            
        });
    </script>

@endpush