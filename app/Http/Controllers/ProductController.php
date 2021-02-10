<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index()
    {
        // $data = Product::all();
        // $data = Product::with('product_variant')->get();
        // $data = ProductVariant::with('product')->get()->first();
        // $data = $data->product()->with('category')->get()->first()->name;

        // foreach($data as $datas){
        //     $variant = json_decode($datas->variant);
        //     // print_r($variant);
        //     // echo '<br>';
        //     foreach($variant as $variants){
        //         $data = $variants->value;
        //     }
        // }
        // dd($data);
        return view('product.index');
    }
    
    public function index_datatable()
    {   
        // $data = Product::all();
        $data = ProductVariant::with('product')->get();

        // $data = Product::with('product_variant')->get();
        return DataTables::of($data)
            ->editColumn('product_name', function ($row)
            {
                $variant = json_decode($row->variant);
                $data = $row->product->name;
                
                foreach($variant as $variants){
                    $data .= ' - '.$variants->value;
                }
                return $data;
            })
            ->editColumn('category', function ($row)
            {
                $data = ProductCategory::find($row->product->category);
                return $data->name;
            })
            ->editColumn('buying_price', function ($row)
            {
                if(is_null($row->buying_price)){
                    return 'NOT FOUND';
                }else{
                    $data = "RM".$row->buying_price;
                    return $data;
                }
            })
            ->editColumn('selling_price_per_unit', function ($row)
            {
                if(is_null($row->selling_price_per_unit)){
                    return 'NOT FOUND';
                }else{
                    $data = "RM".$row->selling_price_per_unit;
                    return $data;

                }
            })
            ->editColumn('action', function ()
            {
                $button = '
                    <button class="btn btn-sm btn-primary"> View </button>
                    <button class="btn btn-sm btn-secondary"> Edit </button>
                ';
                return $button;
            })
            // ->rawColumns(['category','selling_price_per_unit', 'stock', 'buying_date'])
            ->make(true);
    }
}
