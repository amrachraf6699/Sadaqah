<?php

namespace App\Filament\Resources\WithdrawResource\Pages;

use App\Filament\Resources\WithdrawResource;
use App\Filament\Resources\WithdrawResource\Widgets\WithdrawWidget;
use App\Models\Withdraw;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords;

class ListWithdraws extends ListRecords
{
    protected static string $resource = WithdrawResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }

    public function getHeaderWidgets(): array
    {
        return [
            WithdrawWidget::class,
        ];
    }

    public function getTabs(): array
    {
        return [
            Tab::make('All')
                ->icon('heroicon-o-archive-box')
                ->badge(Withdraw::count())
                ->badgeColor(Withdraw::count() > 0 ? 'success' : 'danger')
                ->modifyQueryUsing(function (Builder $query) {
                    $query->get();
                }),
            Tab::make('Pending')
                ->icon('heroicon-o-clock')
                ->badge(Withdraw::query()->where('status', 'pending')->count())
                ->badgeColor(Withdraw::query()->where('status', 'pending')->count() > 0 ? 'success' : 'danger')
                ->modifyQueryUsing(function (Builder $query) {
                    $query->where('status', 'pending');
                }),

            Tab::make('Processing')
                ->icon('heroicon-o-cog')
                ->badge(Withdraw::query()->where('status', 'processing')->count())
                ->badgeColor(Withdraw::query()->where('status', 'processing')->count() > 0 ? 'success' : 'danger')
                ->modifyQueryUsing(function (Builder $query) {
                    $query->where('status', 'processing');
                }),

            Tab::make('Rejected')
                ->icon('heroicon-o-x-circle')
                ->badge(Withdraw::query()->where('status', 'regected')->count())
                ->badgeColor(Withdraw::query()->where('status', 'regected')->count() > 0 ? 'success' : 'danger')
                ->modifyQueryUsing(function (Builder $query) {
                    $query->where('status', 'regected');
                }),

            Tab::make('Paying')
                ->icon('heroicon-o-arrow-path')
                ->badge(Withdraw::query()->where('status', 'paying')->count())
                ->badgeColor(Withdraw::query()->where('status', 'paying')->count() > 0 ? 'success' : 'danger')
                ->modifyQueryUsing(function (Builder $query) {
                    $query->where('status', 'paying');
                }),
            Tab::make('Paid')
                ->icon('heroicon-o-check-badge')
                ->badge(Withdraw::query()->where('status', 'paid')->count())
                ->badgeColor(Withdraw::query()->where('status', 'paid')->count() > 0 ? 'success' : 'danger')
                ->modifyQueryUsing(function (Builder $query) {
                    $query->where('status', 'paid');
                }),


        ];
    }
}
