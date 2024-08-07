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
    //Login Routes
    Route::view('login','auth.login')->name('login');
    Route::post('login',[AuthController::class,'login']);
    //Register Routes
    Route::view('register','auth.register')->name('register');
    Route::post('register',[AuthController::class,'register']);
    //Forgot Password Routes
    Route::view('forgot', 'auth.forgot')->name('forgot');
    Route::post('forgot', [AuthController::class, 'forgot']);
    //Reset Password Routes
    Route::view('reset/{token}', 'auth.reset')->name('reset');
    Route::post('reset/{token}', [AuthController::class, 'reset']);

});

Route::group(['prefix'=>'auth','middleware'=>'auth'],function(){
    Route::get('logout',[AuthController::class,'logout'])->name('logout');
});
