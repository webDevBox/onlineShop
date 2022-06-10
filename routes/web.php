<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\ProductController;

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

Route::get('/',[PanelController::class , 'index']);
Route::post('/login',[AuthController::class , 'login'])->name('login');
Route::post('/signup',[PanelController::class , 'signup'])->name('signup');
Route::post('/order',[PanelController::class , 'order'])->name('order');
Route::post('/edit_user_db/{id}',[PanelController::class , 'edit_user_db'])->name('edit_user_db');
Route::get('/logout',[AuthController::class , 'logout'])->name('logout');
Route::get('/dashboard',[PanelController::class , 'dashboard'])->name('dashboard');
Route::get('/del_buyer_list',[PanelController::class , 'del_buyer_list'])->name('del_buyer_list');
Route::get('/summary',[PanelController::class , 'summary'])->name('summary');
Route::get('/del_user/{id}',[PanelController::class , 'del_user'])->name('del_user');
Route::get('/del_order/{id}',[PanelController::class , 'del_order'])->name('del_order');
Route::get('/active_user/{id}',[PanelController::class , 'active_user'])->name('active_user');
Route::get('/edit_user/{id}',[PanelController::class , 'edit_user'])->name('edit_user');
Route::get('/complete_order/{id}',[PanelController::class , 'complete_order'])->name('complete_order');
Route::get('/detail_user/{id}',[PanelController::class , 'detail_user'])->name('detail_user');

Route::group(['prefix' => 'product','middleware' => 'auth.admin'], function(){
Route::get('/',[ProductController::class, 'index'])->name('products');
Route::post('/create',[ProductController::class, 'store'])->name('addProduct');
Route::get('/delete/{id}',[ProductController::class, 'destroy'])->name('del_product');
Route::get('/edit/{id}',[ProductController::class, 'edit'])->name('edit_product');
});