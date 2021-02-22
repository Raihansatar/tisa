@extends('layouts.main')


@section('content')

<div class="d-flex justify-content-between">
    <div class="d-flex align-items-end">
        <div class="d-flex pe-2">
            <h1>Debt</h1>
        </div>
        <div class="d-flex ps-2">
            <ul class="breadcrumb">
                <li class="breadcrumb-item">Username</li>
            </ul>
        </div>
    </div>

    <div class="d-flex align-items-center justify-content-between">
        <div class="">
            <button class="d-flex align-items-center btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addDebtModal">
                <i class="bi bi-plus-square"></i>
                <span>Add</span>
            </button>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="addDebtModal" tabindex="-1" aria-labelledby="addDebtModal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="">Add </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="row g-3" id="addDebtForm" action="" method="POST">
            @csrf
            <div class="modal-body">
                <div class="px-4">
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="debt_name" class="col-form-label">Title</label>
                            <input class="form-control col-12" name="debt_title" id="debt_title" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="col-form-label col-12" for="">Amount</label>
                            <input type="number" class="form-control col-12" name="debt_amount" id="debt_amount">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="debt_description" class="col-form-label">Note</label>
                            <textarea class="form-control" placeholder="" id="debt_description" name="debt_description" style="height: 100px"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        
        </div>
    </div>
</div>

<div class="card card-custom">
    <div class="card-header"> Today's debt (Date) </div>
    <div class="card-body">
        <form class="row row-cols-lg-auto g-3 align-items-center">
            <div class="col-12">
                <label for="" class="form-label"> Filter: </label>
            </div>

            <div class="col-12">
                <label class="visually-hidden" for="from_date">Date</label>
                <div class="input-group">
                    <div class="input-group-text">From</div>
                    <input type="date" class="form-control" id="from_date" placeholder="">
                </div>
            </div>

            <div class="col-12">
                <label class="visually-hidden" for="to_date">Date</label>
                <div class="input-group">
                    <div class="input-group-text">To</div>
                    <input type="date" class="form-control" id="to_date" placeholder="">
                </div>
            </div>
            
            {{-- <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="inlineFormCheck">
                    <label class="form-check-label" for="inlineFormCheck">
                    Remember me
                    </label>
                </div>
            </div> --}}
            
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        <div>
            <table class="table" id="debt_datatable">
                <thead>
                    <th>Title</th>
                    <th>Amount</th>
                    <th>Note</th>
                    <th>Time</th>
                    <th>Status</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Milo air</td>
                        <td>RM45</td>
                        <td>takdop note</td>
                        <td>marin dulu</td>
                        <td>
                            <button class="btn btn-sm btn-outline-danger">
                                Unpaid
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>Corntoz</td>
                        <td>RM0.20</td>
                        <td>takdop note</td>
                        <td>Tadi jah baru</td>
                        <td>
                            <button class="btn btn-sm btn-outline-success">
                                Paid
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
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

    <script>
        $('document').ready(function(){
            $('#addDebtForm').submit(function(e){
                e.preventDefault();

                console.log($(this).serialize())

                $.ajax({
                    url: '{{ route('debt.ajax.createDebt') }}',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'JSON',
                    success: function(data){
                        console.table(data)
                    }
                })
            })

            var table = $('#debt_datatable').DataTable({
                "responsive": true,
                // "serverSide": true,
                // "ajax": "{{ route('product.index.datatable') }}",
                // "columns": [
                //     {data: 'product_name', name: 'product_name'},
                //     {data: 'category', name: 'category'},
                //     {data: 'buying_price', name: 'buying_price'},
                //     {data: 'selling_price_per_unit', name: 'selling_price_per_unit'},
                //     {data: 'stock', name: 'stock'},
                //     {data: 'buying_date', name: 'buying_date'},
                //     {data: 'action', name: 'action'},
                // ],
                // "columnDefs": [
                //     {
                //         targets: 5,
                //         "render": function ( data, type, row ) {
                //             return moment(data).calendar();;
                //         },
                //     },
                // ]
            });

        });
    </script>
@endpush

