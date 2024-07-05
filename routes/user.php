<?php

use App\Http\Controllers\{CampaignsController,HomeController, PaymentController};
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

Route::get('',function(){
    dd(auth()->user());
})->name('profile');
//Payment Routes
Route::post('campaign/{campaign:slug}/donate',[PaymentController::class,'donate'])->name('donate');
Route::get('stripe/success', [PaymentController::class, 'handleStripeSuccess'])->name('stripe.success');
Route::get('payment/cancel', [PaymentController::class, 'handleCancel'])->name('payment.cancel');
