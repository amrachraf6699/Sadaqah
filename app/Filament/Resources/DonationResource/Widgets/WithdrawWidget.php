<?php

namespace App\Filament\Resources\DonationResource\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Withdraw; // Ensure this is the correct model for your withdrawals

class WithdrawWidget extends ChartWidget
{
    protected static ?string $heading = 'Withdrawals by Status';

    protected function getData(): array
    {
        // Fetch data and count withdrawals by status
        $statuses = ['pending', 'processing', 'paying', 'paid', 'regected'];
        $counts = [];

        foreach ($statuses as $status) {
            $counts[$status] = Withdraw::where('status', $status)->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Withdrawals',
                    'data' => array_values($counts),
                    'backgroundColor' => [
                        'rgba(255, 99, 132, 0.2)', // Color for 'pending'
                        'rgba(54, 162, 235, 0.2)', // Color for 'processing'
                        'rgba(255, 206, 86, 0.2)', // Color for 'paying'
                        'rgba(75, 192, 192, 0.2)', // Color for 'paid'
                        'rgba(153, 102, 255, 0.2)', // Color for 'regected'
                    ],
                    'borderColor' => [
                        'rgba(255, 99, 132, 1)', // Border color for 'pending'
                        'rgba(54, 162, 235, 1)', // Border color for 'processing'
                        'rgba(255, 206, 86, 1)', // Border color for 'paying'
                        'rgba(75, 192, 192, 1)', // Border color for 'paid'
                        'rgba(153, 102, 255, 1)', // Border color for 'regected'
                    ],
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $statuses,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
