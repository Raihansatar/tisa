<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class DebtController extends Controller
{
    public function index()
    {
        return view('debt.index');
    }

    public function debtDatatable(Request $request)
    {

        if($request->date != null){
            $data = Debt::where('user_id', Auth::id())->get();
        }else{
            $data = Debt::where('user_id', Auth::id())->whereDate('created_at', '=', date('Y-m-d').' 00:00:00')->get();
        }

        return DataTables::of($data)
            ->editColumn('datetime', function ($row)
            {
                return $row->created_at;
            })
            ->editColumn('note', function ($row)
            {
                if($row->note!=null){
                    return $row->note;
                }else{
                    return "No Note";
                }
            })
            ->editColumn('status', function ($row)
            {
                if($row->status == 'unpaid'){
                    $button = '<button class="btn btn-sm btn-outline-danger">Unpaid</button>';
                }elseif($row->status == 'paid'){
                    $button = '<button class="btn btn-sm btn-outline-success">Paid</button>';
                }elseif($row->status == 'half-pay'){
                    $button = '<button class="btn btn-sm btn-outline-secondary">Half-Paid</button>';
                }else{
                    $button = "ERROR";
                }
                return $button;
            })
            ->rawColumns(['status'])
            ->make(true);
        // return $data;
    }

    public function createDebt(Request $request)
    {
        $data = Debt::create([
            'user_id' => Auth::id(),
            'title' => $request->debt_title,
            'amount' => $request->debt_amount,
            'note' => $request->debt_description,
            'status' => 'unpaid'
        ]);

        return response()->json($data);
    }
}
