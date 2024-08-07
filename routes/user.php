<?php

use App\Http\Controllers\{PaymentController, PDFController};
use App\Http\Controllers\User\{CampaignsController, NotificationsController, ProfileController, WithdrawController};
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

//Profile Routes
Route::get('',[ProfileController::class,'index'])->name('profile');
Route::view('edit','user.edit')->name('edit');
Route::post('edit',[ProfileController::class, 'update'])->name('update');

//Payment Routes
Route::post('campaign/{campaign:slug}/donate',[PaymentController::class,'donate'])->name('donate');
Route::get('stripe/success', [PaymentController::class, 'handleStripeSuccess'])->name('stripe.success');
Route::get('payment/cancel', [PaymentController::class, 'handleCancel'])->name('payment.cancel');

//PDF Routes
Route::get('download/invoice', PDFController::class)->name('download.invoice');
Route::get('download/thanks', PDFController::class)->name('download.thanks');


//Campaign Routes
Route::view('campaign/create','user.campaign.create')->name('campaign.create');
Route::post('campaign/create',[CampaignsController::class, 'storeCampaign'])->name('campaign.store');
Route::get('campaign/{campaign:slug}/edit',[CampaignsController::class, 'editCampaign'])->name('campaign.edit');
Route::put('campaign/{campaign:slug}/update',[CampaignsController::class, 'updateCampaign'])->name('campaign.update');
Route::delete('campaign/{campaign:slug}/delete',[CampaignsController::class, 'deleteCampaign'])->name('campaign.delete');

//Notification Routes
Route::get('notifications', [NotificationsController::class, 'index'])->name('notifications');
Route::get('notifications/{notification:id}', [NotificationsController::class, 'show'])->name('notifications.show');


//Withdrawing Routes
Route::get('withdraw',[WithdrawController::class, 'create'])->name('withdraw.create');
Route::post('withdraw',[WithdrawController::class, 'store'])->name('withdraw.store');
