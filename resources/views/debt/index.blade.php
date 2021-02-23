@extends('layouts.main')


@section('content')

<div class="subheader py-2 py-lg-6  subheader-transparent " id="kt_subheader">
    <div class="container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">

        <div class="d-flex align-items-center flex-wrap mr-1">
			<div class="d-flex align-items-baseline flex-wrap mr-5">
	            <h5 class="text-dark font-weight-bold my-1 mr-5">
	                Debt
                </h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">
                            username</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="d-flex align-items-center">
            {{-- <a href="#" class="btn btn-light-primary font-weight-bolder btn-sm">
                Actions
            </a> --}}
            <button class="d-flex align-items-center btn btn-sm btn-light-primary" data-toggle="modal" data-target="#addDebtModal">
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
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="row g-3" id="addDebtForm" action="" method="POST">
            @csrf
            <div class="modal-body">
                <div class="px-4">
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="debt_name" class="col-form-label">Title <span style="color: red">*</span></label>
                            <input class="form-control col-12" name="debt_title" id="debt_title" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="col-form-label col-12" for="">Amount <span style="color: red">*</span></label>
                            <input type="number" class="form-control col-12" name="debt_amount" id="debt_amount" required>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        
        </div>
    </div>
</div>

<div class="container">
    <div class="row pb-4 pt-2">
        <div class="col-4">
            <div class="card bg-danger text-white p-3">
               <span id="total_unpaid"></span>
            </div>
        </div>
        <div class="col-4">
            <div class="card bg-success text-white p-3">
                <span id="total_paid"></span>
            </div>
        </div>
        <div class="col-4">
            <div class="card bg-warning p-3">
                <span id="total_all"></span>
            </div>
        </div>
    </div>
    
    <div class="card">
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
                
                <div class="col-12">
                    <button type="button" value="show_today" id="filter_today" class="btn btn-primary button-filter">Today</button>
                </div>
                <div class="col-12">
                    <button type="button" value="show_all" id="filter_show_all" class="btn btn-success button-filter">Show All</button>
                </div>
                <div class="col-12">
                    <button type="button" value="reset" id="filter_reset" class="btn btn-danger button-filter">Reset</button>
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>
@endsection

@push('custom-css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('custom-js')
\
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/select2.js') }}"></script>

    <script>
        $('document').ready(function(){
            var filter = null;
            getTotal()
            function getTotal(){
                $.ajax({
                    url: '{{ route('debt.ajax.getTotalDebt') }}',
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(data){
                        console.table(data)
                        $('#total_paid').html('Paid: RM' + data.paid)
                        $('#total_unpaid').html('Unpaid: RM' + data.unpaid)
                        $('#total_all').html('Total: RM' + data.total)
                    }
                })
            }

            $('#filter_show_all').click(function(){
                filter = $(this).val();
                $(this).addClass('active');
                $('#filter_today').removeClass('active');
                $('#filter_reset').removeClass('active');
                $('#from_date').val('');
                $('#to_date').val('');
                debt_datatable.draw();
            });

            $('#filter_today').click(function(){
                filter = $(this).val();
                $(this).addClass('active');
                $('#filter_show_all').removeClass('active');
                $('#filter_reset').removeClass('active');
                $('#from_date').val('');
                $('#to_date').val('');
                debt_datatable.draw();
            });

            $('#filter_reset').click(function(){
                filter = $(this).val();
                $(this).addClass('active');
                $('#filter_show_all').removeClass('active');
                $('#filter_today').removeClass('active');


                debt_datatable.draw();
            });

            $('#from_date').change(function(){
                filter = null
                debt_datatable.draw()
            });

            $('#to_date').change(function(){
                filter = null
                debt_datatable.draw()
            });

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
                        if(data.id!=null){
                            $('#addDebtModal').modal('toggle');
                            $('#addDebtForm').trigger("reset");
                            debt_datatable.draw();
                            getTotal()
                        }else{
                            alert('Error Occur')
                        }
                    }
                })
            })

            var debt_datatable = $('#debt_datatable').DataTable({
                "responsive": true,
                "serverSide": true,
                "ajax": {
                    url: "{{ route('debt.ajax.datatable') }}",
                    data: {
                        from_date: function(){
                            if($('#from_date').val() == null){
                                return null;
                            }else{
                                return $('#from_date').val().toString()
                            }
                        },
                        to_date: function(){
                            if($('#to_date').val() == null){
                                return null;
                            }else{
                                return $('#to_date').val().toString()
                            }
                        },
                        filter: function(){
                            return filter;
                        }
                    },
                },
                "columns": [
                    {data: 'title', name: 'title'},
                    {data: 'amount', name: 'category'},
                    {data: 'note', name: 'note'},
                    {data: 'datetime', name: 'datetime'},
                    {data: 'status', name: 'status'},
                ],
                "order": [[ 3, "desc" ]],
                "columnDefs": [
                    {
                        targets: 3,
                        "render": function ( data, type, row ) {
                            return moment(data).calendar();;
                        },
                    },
                ]
            });

        });
    </script>
@endpush

