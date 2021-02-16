<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
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
    
    Route::prefix('debt')->group(function () {
        Route::get('/', function () {
            return view('debt.index');
        })->name('debt.index');
    });

    Route::prefix('sales')->group(function () {
        Route::get('/', [SalesController::class, 'index'])->name('sales.index');
    });

    Route::prefix('product')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('product.index');
        Route::post('/', [ProductController::class, 'createProduct'])->name('product.create');
        Route::get('/datatable', [ProductController::class, 'index_datatable'])->name('product.index.datatable');
        
        Route::prefix('api')->group(function () {
            Route::post('/createProduct', [ProductController::class, 'createProduct'] )->name('product.createProduct');
            Route::post('/addVariant', [ProductController::class, 'addVariant'] )->name('product.addVariant');
            Route::get('/getProduct', [ProductController::class, 'getProduct'])->name('product.api.getProduct');
            Route::get('/getProductVariant', [ProductController::class, 'getProductVariant'])->name('product.api.getProductVariant');
            Route::get('/getProductDetails', [ProductController::class, 'getProductDetails'])->name('product.api.getProductDetails');
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
    
    });
    
});
