<?php

use App\Http\Controllers\{PaymentController, PDFController};
use App\Http\Controllers\User\ProfileController;
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

Route::get('',[ProfileController::class,'index'])->name('profile');
//Payment Routes
Route::post('campaign/{campaign:slug}/donate',[PaymentController::class,'donate'])->name('donate');
Route::get('stripe/success', [PaymentController::class, 'handleStripeSuccess'])->name('stripe.success');
Route::get('payment/cancel', [PaymentController::class, 'handleCancel'])->name('payment.cancel');


Route::get('download/invoice', PDFController::class)->name('download.invoice');
Route::get('download/thanks', PDFController::class)->name('download.thanks');

Route::view('edit','user.edit')->name('edit');
Route::post('edit',[ProfileController::class, 'update'])->name('update');

Route::get('campaign/{campaign:slug}/edit',[ProfileController::class, 'editCampaign'])->name('campaign.edit');
Route::put('campaign/{campaign:slug}/update',[ProfileController::class, 'updateCampaign'])->name('campaign.update');
