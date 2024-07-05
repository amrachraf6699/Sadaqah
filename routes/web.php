<?php

use App\Http\Controllers\{CampaignsController,HomeController, PaymentController, ProfileController};
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

Route::get('profile/{user:uuid}',ProfileController::class)->name('profile.show');
//Thank you page
Route::view('thank-you', 'thank-you')->name('thank-you');
