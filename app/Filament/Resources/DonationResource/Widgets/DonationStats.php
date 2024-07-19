<?php

namespace App\Filament\Resources\DOnationResource\Widgets;

use App\Models\Donation;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DonationStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Donations', Donation::count())
                ->chart([rand(1,29), rand(1,29), rand(1,29), rand(1,29), rand(1,29), rand(1,29)])
                ->color('danger')
                ->icon('heroicon-o-currency-dollar'),

            Stat::make('Total Amount', number_format(Donation::sum('amount'), 2) . ' $')
                ->chart([rand(1,29), rand(1,29), rand(1,29), rand(1,29), rand(1,29), rand(1,29)])
                ->color('success')
                ->icon('heroicon-o-currency-dollar'),

            Stat::make('Average Amount', number_format(Donation::avg('amount'), 2) . ' $')
                ->chart([rand(1,29), rand(1,29), rand(1,29), rand(1,29), rand(1,29), rand(1,29)])
                ->color('warning')
                ->icon('heroicon-o-star'),

            Stat::make('Donated Users', Donation::distinct('user_id')->count())
                ->chart([rand(1,29), rand(1,29), rand(1,29), rand(1,29), rand(1,29), rand(1,29)])
                ->color('primary')
                ->icon('heroicon-o-finger-print'),

        ];
    }
}
