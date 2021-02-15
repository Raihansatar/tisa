<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Models\ProductVariant;
use Exception;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $category = ProductCategory::all();
        $brand = ProductBrand::all();
        return view('product.index', ['categories' => $category, 'brands' => $brand]);
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

    public function createProduct(Request $request)
    {
        try{
            $product = Product::create([
                'user_id' => Auth::id(),
                'name' => $request->product_name,
                'description' => $request->product_description,
                'brand' => $request->product_brand,
                'category' => $request->product_category
            ]);
    
            $product_variant = ProductVariant::create([
                'product_id' => $product->id,
                'variant' => $request->product_variasi,
                'buying_price' => $request->product_buying_price,
                'selling_price_per_unit' => $request->product_selling_price,
                'stock' => $request->product_stock
            ]);
            return response()->json($product_variant);
        }catch(Exception $e){
            return response()->json($e);
        }
        
    }
    
    public function getProduct(Request $request)
    {
        $data = [];
            
        try{
            if($request->has('q')){
                $search = $request->q;
                $data = Product::select("id","name", "brand")
                        ->with('brand:name')
                        ->where('name','LIKE',"%$search%")
                        ->get();
            }else{
                $data = Product::select("id","name", "brand")
                        ->with('brand:name')
                        ->get();
            }
    
        }catch(Exception $e){
            return $e;
        }
    
    
        return response()->json($data);
    }

    public function getProductDetails(Request $request)
    {
        $data = [];
            
        try{
            if($request->has('id')){
                $search = $request->data;
                $data = Product::
                        // with(['brand', 'category'])
                        where('id', $search)
                        ->get();
            }else{
                // $data = Product::select("id","name", "brand")
                //         ->with('brand:name')
                //         ->get();
                $search = $request->data;
                $data = Product::
                // with(['brand', 'category'])
                        where('id', $search)
                        ->get();
            }
    
            return response()->json($data);
        }catch(Exception $e){
            return $e;
            return response()->json($e);

        }
    
    
    }
}
