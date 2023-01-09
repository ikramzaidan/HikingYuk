<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;


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

Route::get('/', [HomeController::class, 'index']);

Route::get('/product/{id}', [ProductController::class, 'index']);
Route::post('/product/{id}', [CartController::class, 'store']);
Route::get('/categories/all', [CategoryController::class, 'index']);
Route::get('/categories/{category:slug}', [CategoryController::class, 'category']);

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function() {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/profile', [DashboardController::class, 'profile']);
    Route::post('/profile', [DashboardController::class, 'update']);
    Route::post('/profile/insertPhoto', [DashboardController::class, 'update_photo']);
    Route::get('/products', [DashboardController::class, 'product']);
    Route::get('/product/create', [ProductController::class, 'create']);
    Route::post('/product/create', [ProductController::class, 'store']);
    Route::get('/product/update/{id}', [ProductController::class, 'edit']);
    Route::post('/product/update/{id}', [ProductController::class, 'update']);
    Route::delete('/product/delete/{id}', [ProductController::class, 'destroy']);
    Route::post('/product/create', [ProductController::class, 'store']);
    Route::get('/cart', [CartController::class, 'index']);
    Route::delete('/cart/{id}', [CartController::class, 'destroy']);
});

Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'auth']);
Route::post('/logout', [LoginController::class, 'destroy']);
Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);
