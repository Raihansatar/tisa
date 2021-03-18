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
    
    public function getAllDebt()
    {
        $data = Debt::orderBy('created_at', 'DESC')->get();
        return $data;
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
            ->editColumn('amount', function ($row)
            {
                return 'RM' . number_format($row->amount, 2, '.', ' ');
                
            })
            ->editColumn('paid', function ($row)
            {
                return 'RM' . number_format($row->paid, 2, '.', ' ');
                
            })
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
                    $button = '<span class="label label-lg label-light-danger label-inline">Unpaid</span>';
                }elseif($row->status == 'paid'){
                    $button = '<span class="label label-lg label-light-success label-inline">Paid</span>';
                }elseif($row->status == 'partial'){
                    $button = '<span class="label label-lg label-light-warning label-inline">Partial</span>';
                }else{
                    $button = "ERROR";
                }
                return $button;
            })
            ->editColumn('action', function ($row)
            {
                if($row->status == 'paid'){
                    $button = '<button class="btn btn-sm btn-danger mr-2 edit_pay" title="Edit details" data-id=" '.$row->id.'"> Edit </button>';
                    return $button;
                }else{
                    $button = '<button class="btn btn-sm btn-info mr-2 button_pay" title="Edit details" data-id=" '.$row->id.'"> Pay </button>';
                    return $button;
                }
            })
            ->rawColumns(['status', 'action'])
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
        $data['unpaid'] =  number_format(Debt::where('user_id', Auth::id())->where('status', 'unpaid')->sum('amount'), 2, '.', ' ');
        $data['paid'] = number_format(Debt::where('user_id', Auth::id())->where('status', 'paid')->sum('amount') + Debt::where('user_id', Auth::id())->where('status', 'partial')->sum('paid'), 2, '.', ' ');
        $data['total'] = number_format($data['unpaid'] + $data['paid'], 2, '.', ' ');

        // $data['partial_paid'] = Debt::where('user_id', Auth::id())->where('status', 'partial')->sum('paid');
        
        return response()->json($data);
    }

    public function payOneDebt(Request $request)
    {
        // $debt = Debt::where('user_id', Auth::id())->where('id', $request->id)->get();
        $debt = Debt::find($request->id);
        if($debt == null){
            $data['success'] = false;
            $data['message'] = 'Error Debt not found';
        }else{
            if($debt->status == 'unpaid'){
                if($debt->amount <= $request->pay_amount){
                    $debt->paid = $debt->amount;
                    $debt->status = 'paid';
                    $debt->save();
                    $data['success'] = true;
                    $data['message'] = 'successfully paid';
                }else if($debt->amount >= $request->pay_amount && $request->pay_amount > 0){
                    $debt->paid = $request->pay_amount;
                    $debt->status = 'partial';
                    $debt->save();
                    $data['success'] = true;
                    $data['message'] = 'successfully partially paid';
                }
            }else if($debt->status == 'partial'){
                if(($debt->amount - $debt->paid) <= $request->pay_amount){
                    $debt->paid = $debt->amount;
                    $debt->status = 'paid';
                    $debt->save();
                    $data['success'] = true;
                    $data['message'] = 'successfully paid';
                }else if(($debt->amount - $debt->paid) >= $request->pay_amount && $request->pay_amount > 0){
                    $debt->paid = $request->pay_amount;
                    // $debt->status = 'partial';
                    $debt->save();
                    $data['success'] = true;
                    $data['message'] = 'successfully partially paid';
                }
            }
        }

        return response()->json($data);
    }

    public function payDebt(Request $request)
    {
    $pay_amount = $request->pay_amount;
       $data = $this->exceedDebtAmount($pay_amount);
       $pay_amount = (double)$pay_amount;
        if(!$data['status']){
            $unpaid_list = Debt::where('user_id', Auth::id())->where('status', 'unpaid')->orwhere('status', 'partial')->orderBy('created_at', 'asc')->get();
            $data['unpaid_list'] = $unpaid_list;
            $data['increment'] = 0;
            foreach($unpaid_list as $list){
                
                
                if($list['status'] == 'unpaid'){
                    
                    if($list['amount'] <= $pay_amount){
                        $debt = Debt::find($list['id']);
                        $debt->paid = $list['amount'];
                        $debt->status = 'paid';
                        $debt->save();
                        $pay_amount = (double)$pay_amount - (double)$list['amount'];
                        if(is_null($pay_amount)){
                            break;
                        }
                        $data['increment']++;
                    }
                }elseif($list['status'] == 'partial'){

                }
            }
        }

        return response()->json($data);
    }

    protected function exceedDebtAmount($amount)
    {
        // $unpaid = Debt::where('user_id', Auth::id())->where('status', 'unpaid')->orwhere('status', 'partial')->sum('amount');
        $unpaid['total'] = Debt::where('user_id', Auth::id())->where('status', 'unpaid')->sum('amount');
        // $unpaid['total'] = $unpaid['total'] + Debt::where('user_id', Auth::id())->where('status', 'unpaid')->orwhere('status', 'partial')->sum('amount');
        // KIV dulu
        // kena tambah status extra money(wallet)
        if($amount <= $unpaid['total']){
            $unpaid['status'] = false;
            return $unpaid;
        }else{
            $unpaid['status'] = true;
            return $unpaid;
        }
    }
}
