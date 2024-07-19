<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions\CreateAction;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    public function getTabs(): array
    {
        return [
            Tab::make('All')
            ->badge(User::query()->count())
            ->badgeColor('success')
            ->icon('heroicon-o-user-group'),

            Tab::make('Users')
            ->icon('heroicon-o-users')
            ->badge(User::query()->where('is_admin', false)->count())
            ->badgeColor(User::query()->where('is_admin', false)->count() > 0 ? 'success' : 'danger')
            ->modifyQueryUsing(function (Builder $query) {
                $query->where('is_admin', false);
            }),
            Tab::make('Admins')
                ->badge(User::query()->where('is_admin', true)->count())
                ->badgeColor(User::query()->where('is_admin', true)->count() > 0 ? 'success' : 'danger')
                ->icon('heroicon-o-check-badge')
                ->modifyQueryUsing(function (Builder $query) {
                    $query->where('is_admin', true);
                }),
            Tab::make('With Balance')
                ->badge(User::query()->where('balance', '>', 0)->count())
                ->badgeColor(User::query()->where('balance', '>', 0)->count() > 0 ? 'success' : 'danger')
                ->icon('heroicon-o-face-smile')
                ->modifyQueryUsing(function (Builder $query) {
                    $query->where('balance', '>', 0);
                }),

            Tab::make('Without Balance')
                ->badge(User::query()->where('balance', 0)->count())
                ->badgeColor(User::query()->where('balance', 0)->count() > 0 ? 'success' : 'danger')
                ->icon('heroicon-o-face-frown')
                ->modifyQueryUsing(function (Builder $query) {
                    $query->where('balance', 0);
                }),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
            ->label('Create new User')
            ->icon('heroicon-o-plus-circle')
        ];
    }
}
