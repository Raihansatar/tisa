<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function index()
    {
        return view('sales.index');
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
        // Transaction::create([
        //     'user_id' => Auth::id(),
        //     'product_id' => $request->product_name,
        //     ''
        // ]);
        return response()->json($request);
    }
}
