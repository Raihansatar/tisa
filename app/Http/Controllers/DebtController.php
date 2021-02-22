<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DebtController extends Controller
{
    public function index()
    {
        return view('debt.index');
    }

    public function debtDatatable(Request $request)
    {
        dd($request);
        // return $data;
    }

    public function createDebt(Request $request)
    {
        Debt::create([
            'user_id' => Auth::id(),
            'title' => $request->debt_title,
            'debt' => $request->debt_amount,
            'note' => $request->debt_description,
            'status' => 'unpaid'
        ]);
        // dd($request);
        return response()->json($request);
    }
}
