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

Route::get('/', HomeController::class)->name('home');
Route::get('campaigns',[CampaignsController::class,'index'])->name('campaigns.index');
Route::get('campaign/{campaign:slug}',[CampaignsController::class,'show'])->name('campaigns.show');


//Payment Routes
Route::post('campaign/{campaign:slug}/donate',[PaymentController::class,'donate'])->name('campaigns.donate');
Route::get('stripe/success', [PaymentController::class, 'handleStripeSuccess'])->name('stripe.success');
Route::get('paypal/success', [PaymentController::class, 'handlePaypalSuccess'])->name('paypal.success');
Route::get('payment/cancel', [PaymentController::class, 'handleCancel'])->name('payment.cancel');


//Thank you page
Route::view('thank-you', 'thank-you')->name('thank-you');
