<?php

namespace App\Filament\Resources\DonationResource\Pages;

use App\Filament\Resources\DonationResource;
use App\Filament\Resources\DonationResource\Widgets\DonationWidget;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDonations extends ListRecords
{
    protected static string $resource = DonationResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            DonationWidget::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
