<?php

use App\Models\ProductBrand;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/brand', function (Request $request) {
    $data = [];

    try{
        if($request->has('q')){
            $search = $request->q;
            $data =ProductBrand::select("id","name")
                    ->where('name','LIKE',"%$search%")
                    ->get();
        }else{
            $data = ProductBrand::select("id", "name")->get();
        }

    }catch(Exception $e){
        return $e;
    }


    return response()->json($data);
})->name('getBrand');

Route::get('/category', function (Request $request) {
    $data = [];

    try{
        if($request->has('q')){
            $search = $request->q;
            $data =ProductCategory::select("id","name")
                    ->where('name','LIKE',"%$search%")
                    ->get();
        }else{
            $data = ProductCategory::select("id", "name")->get();
        }
        
    }catch(Exception $e){
        return $e;
    }


    return response()->json($data);
})->name('getCategory');

Route::post('/product/variasi/add', function (Request $request) {
    return response()->json($request);
})->name('product.variasi.add');

