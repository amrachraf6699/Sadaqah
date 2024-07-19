<?php

namespace App\Filament\Resources\CampaignResource\Widgets;

use App\Models\Campaign;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Str;

class CampaignWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalCampaigns = Campaign::count();
        $totalCollected = Campaign::sum('current_amount');
        $biggestCampaign = Campaign::orderBy('current_amount', 'desc')->first();

        return [
            Stat::make('Total Campaigns', $totalCampaigns)
                ->icon('heroicon-o-circle-stack')
                ->chart([rand(1,29), rand(1,29), rand(1,29), rand(1,29), rand(1,29), rand(1,29)])
                ->color('danger'),

            Stat::make('Total Collected', number_format($totalCollected, 2) . ' $')
                ->color('success')
                ->chart([rand(1,29), rand(1,29), rand(1,29), rand(1,29), rand(1,29), rand(1,29)])
                ->icon('heroicon-s-currency-dollar'),

            Stat::make('Biggest Campaign', Str::limit($biggestCampaign->title, 15))
                ->chart([rand(1,29), rand(1,29), rand(1,29), rand(1,29), rand(1,29), rand(1,29)])
                ->color('warning')
                ->icon('heroicon-o-star'),
        ];
    }
}

