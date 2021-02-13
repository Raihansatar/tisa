<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return view('index');
})->name('index');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/logout', [LoginController::class, 'logoutProcess'])->name('logout.process');
Route::post('/login', [LoginController::class, 'loginProcess'])->name('login.process');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::post('/product', [ProductController::class, 'createProduct'])->name('product.create');
    Route::get('/product/datatable', [ProductController::class, 'index_datatable'])->name('product.index.datatable');
    Route::post('/product/variasi/add', [ProductController::class, 'createProduct'] )->name('product.variasi.add');

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
});
