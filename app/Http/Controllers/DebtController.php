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
                $button = '<button class="btn btn-sm btn-clean btn-icon mr-2 button_pay" title="Edit details" data-id=" '.$row->id.'"> <span class="svg-icon svg-icon-md"> <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"> <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <rect x="0" y="0" width="24" height="24"></rect> <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "></path> <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"></rect> </g> </svg> </span> Pay </button>';
                return $button;
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
        $data['unpaid'] = Debt::where('user_id', Auth::id())->where('status', 'unpaid')->sum('amount');
        $data['paid'] = Debt::where('user_id', Auth::id())->where('status', 'paid')->sum('amount') + Debt::where('user_id', Auth::id())->where('status', 'partial')->sum('paid');
        $data['total'] = $data['unpaid'] + $data['paid'];

        // $data['partial_paid'] = Debt::where('user_id', Auth::id())->where('status', 'partial')->sum('paid');
        
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
                    // else{
                    //     $debt = Debt::find($list['id']);
                    //     $debt->paid = $debt->paid + $pay_amount;
                    //     $debt->status = 'partial';
                    //     $debt->save();
                    //     $pay_amount = $pay_amount - $pay_amount;
                    //     break;
                    // }
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
