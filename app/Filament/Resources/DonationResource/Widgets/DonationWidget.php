<?php

namespace App\Filament\Resources\DonationResource\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Donation;
use Carbon\Carbon;

class DonationWidget extends ChartWidget
{
    protected static ?string $heading = 'Donations Over Time';

    protected function getData(): array
    {
        $data = Donation::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->map(function ($record) {
                return [
                    'date' => $record->date,
                    'count' => $record->count,
                ];
            });

        $labels = $data->pluck('date')->all();
        $counts = $data->pluck('count')->all();

        return [
            'datasets' => [
                [
                    'label' => 'Donations',
                    'data' => $counts,
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
