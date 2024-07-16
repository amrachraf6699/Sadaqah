<?php

namespace App\Filament\Widgets;

use App\Models\{Campaign,Donation,User, Withdraw};
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TodayWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('', Donation::whereDate('created_at', now())->count())
                ->description('Donations made today')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('success'),

            Stat::make('', User::whereDate('created_at', now())->count())
                ->description('Users registered today')
                ->descriptionIcon('heroicon-o-user')
                ->color('info'),

            Stat::make('', Campaign::whereDate('created_at', now())->count())
                ->description('Campaigns created today')
                ->descriptionIcon('heroicon-o-heart')
                ->color('warning'),

            Stat::make('',Withdraw::whereDate('created_at', now())->count())
                ->description('Withdrawals made today')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('success'),

        ];
    }
}
