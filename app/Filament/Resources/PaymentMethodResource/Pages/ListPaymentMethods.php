<?php

namespace App\Filament\Resources\PaymentMethodResource\Pages;

use App\Filament\Resources\PaymentMethodResource;
use App\Models\PaymentMethod;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListPaymentMethods extends ListRecords
{
    protected static string $resource = PaymentMethodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            Tab::make('All')
                ->badge(PaymentMethod::query()->count())
                ->badgeColor('success')
                ->icon('heroicon-o-currency-dollar'),

            Tab::make('Active')
                ->badge(PaymentMethod::query()->where('is_active', true)->count())
                ->badgeColor(PaymentMethod::query()->where('is_active', true)->count() > 0 ? 'success' : 'danger')
                ->icon('heroicon-o-check-badge')
                ->modifyQueryUsing(function ($query) {
                    $query->where('is_active', true);
                }),

            Tab::make('Inactive')
                ->badge(PaymentMethod::query()->where('is_active', false)->count())
                ->badgeColor(PaymentMethod::query()->where('is_active', false)->count() > 0 ? 'success' : 'danger')
                ->icon('heroicon-o-x-circle')
                ->modifyQueryUsing(function ($query) {
                    $query->where('is_active', false);
                }),
        ];
    }
}
