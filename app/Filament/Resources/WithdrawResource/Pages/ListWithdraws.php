<?php

namespace App\Filament\Resources\WithdrawResource\Pages;

use App\Filament\Resources\DonationResource\Widgets\WithdrawWidget;
use App\Filament\Resources\WithdrawResource;
use Filament\Actions;
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
}
