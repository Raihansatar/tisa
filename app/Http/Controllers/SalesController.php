<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SalesController extends Controller
{
    public function index()
    {
        return view('sales.index');
    }

    public function index_datatable(Request $request)
    {
        $data = Transaction::where('user_id', Auth::id())->get();

        return DataTables::of($data)
            ->editColumn('price_per_unit', function ($row)
            {
                if(is_null($row->price_per_unit)){
                    return 'NOT FOUND';
                }else{
                    $data = "RM".$row->price_per_unit;
                    return $data;
                }
            })
            ->editColumn('total_sales', function ($row)
            {
                if(is_null($row->total_sales)){
                    return 'NOT FOUND';
                }else{
                    $data = "RM".$row->total_sales;
                    return $data;
                }
            })
            ->editColumn('action', function ($row)
            {
                $button = '
                    <button class="btn btn-sm btn-primary"> View </button>
                    <button class="btn btn-sm btn-secondary"> Edit </button>
                ';
                return $button;
            })
            ->make(true)
        ;
    }

    public function getVariantProduct(Request $request)
    {
        $data = [];
        // 'product:id,name'
        try{
            if($request->has('q')){
                $search = $request->q;
                $data = DB::table('product_variants')
                        ->join('products', 'products.id', '=', 'product_variants.product_id')
                        ->select('product_variants.variant', 'product_variants.id', 'product_variants.selling_price_per_unit', 'products.name')
                        ->where('products.name','LIKE',"%$search%")
                        ->orwhere('product_variants.variant','LIKE',"%$search%")
                        ->get();
            }else{
                $data = DB::table('product_variants')
                        ->join('products', 'products.id', '=', 'product_variants.product_id')
                        ->select('product_variants.variant', 'product_variants.id', 'product_variants.selling_price_per_unit', 'products.name')
                        ->get();
            }
    
        }catch(Exception $e){
            return $e;
        }
    
        return response()->json($data);
    }

    public function createSales(Request $request)
    {
        if($request->product_name = 0){
            Transaction::create([
                'user_id' => Auth::id(),
                'unit_sales' => $request->unit_sales,
                'total_sales' => $request->total_sales,
                'date' => $request->sales_date,
            ]);
        }else{
            Transaction::create([
                'user_id' => Auth::id(),
                'product_variant_id' => $request->product_name,
                'product_variant_name' => $request->name,
                'unit_sales' => $request->unit_sales,
                'price_per_unit' => $request->price_per_unit,
                'total_sales' => $request->total_sales,
                'date' => $request->sales_date,
            ]);
        }
        return response()->json($request);
    }
}
