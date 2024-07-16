<?php

namespace App\Filament\Widgets;

use App\Models\Campaign;
use App\Models\Donation;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OverallWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Donations', Donation::count())
                ->description('Total number of donations')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('success'),

            Stat::make('Users', User::count())
                ->description('Total number of users')
                ->descriptionIcon('heroicon-o-user')
                ->color('info'),

            Stat::make('Campaigns', Campaign::count())
                ->description('Total number of campaigns')
                ->descriptionIcon('heroicon-o-heart')
                ->color('warning'),
        ];
    }
}
