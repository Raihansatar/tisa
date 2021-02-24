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

        $data = Debt::where('user_id', Auth::id());

        // $request->filter == 'reset' kiv luh natey ni
        if($request->filter == 'show_all'){
            $data = $data;
        }elseif($request->filter == 'show_today'){
            $data = $data
                        ->whereDate('created_at', '=', date('Y-m-d').' 00:00:00');
        }else{
            if($request->to_date == null && $request->from_date == null){
                // $data = Debt::where('user_id', Auth::id())->get();
                $data = $data
                        ->whereDate('created_at', '=', date('Y-m-d').' 00:00:00');
    
            }elseif($request->to_date == null && $request->from_date != null){
                $data = $data
                        ->whereDate('created_at', '>=', date($request->from_date).' 00:00:00');
    
            }elseif($request->to_date != null && $request->from_date == null){
                $data = $data
                        ->whereDate('created_at', '<=', date($request->to_date).' 00:00:00');
            }
            else{
                $data = $data
                        ->whereDate('created_at', '<=', date($request->to_date).' 00:00:00')
                        ->whereDate('created_at', '>=', date($request->from_date).' 00:00:00');
            }
        }
        
        $data = $data
                ->orderBy('created_at', 'DESC')
                ->get();

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
                    $button = '<span class="label label-lg label-light-primary label-inline">Unpaid</span>';
                }elseif($row->status == 'paid'){
                    $button = '<span class="label label-lg label-light-success label-inline">Paid</span>';
                }elseif($row->status == 'partial'){
                    $button = '<span class="label label-lg label-light-info label-inline">Partial</span>';
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

    public function getTotalDebt()
    {
        $data['unpaid'] = Debt::where('user_id', Auth::id())->where('status', 'unpaid')->sum('amount');
        $data['paid'] = Debt::where('user_id', Auth::id())->where('status', 'paid')->sum('amount') + Debt::where('user_id', Auth::id())->where('status', 'partial')->sum('paid');
        $data['total'] = $data['unpaid'] + $data['paid'];

        // $data['partial_paid'] = Debt::where('user_id', Auth::id())->where('status', 'partial')->sum('paid');
        
        return response()->json($data);
    }
}
