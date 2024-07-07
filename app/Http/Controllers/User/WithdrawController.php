<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateWithdrawRequest;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

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
        $user->withdraws()->create($request->all());

        return redirect()->route('user.profile')->with('success', 'Withdrawal request submitted successfully');
    }
}
