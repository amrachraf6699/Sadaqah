<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateWithdrawRequest;
use App\Jobs\RequestWithdrawJob;
use App\Models\PaymentMethod;

class WithdrawController extends Controller
{
    public function create()
    {
        $payment_methods = PaymentMethod::active()->get();

        return view('user.withdraw.create',compact('payment_methods'));
    }

    public function store(CreateWithdrawRequest $request)
    {
        $user = auth()->user();

        if($user->balance < $request->amount){
            return back()->withErrors('Insufficient balance');
        }

        RequestWithdrawJob::dispatch($request->validated(), $user);

        return redirect()->route('user.profile')->with('success', 'Withdrawal request submitted successfully');
    }
}
