<?php

namespace App\Filament\Resources\WithdrawResource\Widgets;

use App\Models\PaymentMethod;
use App\Models\Withdraw;
use Filament\Widgets\ChartWidget;

class WithdrawWidget extends ChartWidget
{
    protected static ?string $heading = 'Payment Methods Requesting Chart';

    protected function getData(): array
    {
        $paymentMethods = PaymentMethod::all();
        $withdraws = Withdraw::all();

        $withdrawCounts = $paymentMethods->map(function($paymentMethod) use ($withdraws) {
            return $withdraws->where('payment_method_id', $paymentMethod->id)->count();
        });

        return [
            'labels' => $paymentMethods->pluck('name')->toArray(),
            'datasets' => [
                [
                    'label' => 'Withdraws',
                    'data' => $withdrawCounts->toArray(),
                    'backgroundColor' => 'rgba(75, 192, 192, 0.4)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 2,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}


