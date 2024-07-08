<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix'=>'auth','middleware'=>'guest'],function(){
    Route::view('login','auth.login')->name('login');
    Route::post('login',[AuthController::class,'login']);
    Route::view('register','auth.register')->name('register');
    Route::post('register',[AuthController::class,'register']);
});

Route::group(['prefix'=>'auth','middleware'=>'auth'],function(){
    Route::get('logout',[AuthController::class,'logout'])->name('logout');
});
