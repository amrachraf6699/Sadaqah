<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CampaignResource\Pages;
use App\Filament\Resources\CampaignResource\RelationManagers;
use App\Filament\Resources\CampaignResource\Widgets\CampaignWidget;
use App\Models\Campaign;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CampaignResource extends Resource
{
    protected static ?string $model = Campaign::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\ImageColumn::make('image_url')
                    ->circular()
                    ->label(''),

                Tables\Columns\TextColumn::make('title')
                ->searchable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('goal_amount')
                    ->label('Goal')
                    ->badge()
                    ->color('primary')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('current_amount')
                    ->label('Collected')
                    ->badge()
                    ->color(fn (Campaign $campaign) => $campaign->current_amount >= $campaign->goal_amount ? 'success' : 'warning')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('end_date')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('Finished')
                ->query(function (Builder $query) {
                    $query->where('end_date', '<', now());
                }),
                Filter::make('Not Finished')
                ->query(function (Builder $query) {
                    $query->where('end_date', '>=', now());
                }),
                Filter::make('Fully collected')
                ->query(function (Builder $query) {
                    $query->whereColumn('current_amount', '>=', 'goal_amount');
                }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make('View')
                    ->icon('heroicon-o-heart')
                    ->label('View')
                    ->color('gray')
                    ->url(fn (Campaign $campaign) => route('campaigns.show', $campaign))
                    ->openUrlInNewTab(),

                Tables\Actions\Action::make('delete')
                    ->icon('heroicon-o-trash')
                    ->requiresConfirmation()
                    ->color('danger')
                    ->action(fn (Campaign $record) => $record->delete())
                ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }


    public static function getWidgets(): array
    {
        return [
            CampaignWidget::class,
        ];
    }


    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCampaigns::route('/'),
            'create' => Pages\CreateCampaign::route('/create'),
            'edit' => Pages\EditCampaign::route('/{record}/edit'),
        ];
    }
}
