@extends('layouts.main')


@section('content')
    <div class="card card-custom">
        <div class="card-header"> Today's debt (Date) </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <th>Title</th>
                    <th>Amount</th>
                    <th>Time</th>
                    <th>Status</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Milo air</td>
                        <td>RM45</td>
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
@endsection

