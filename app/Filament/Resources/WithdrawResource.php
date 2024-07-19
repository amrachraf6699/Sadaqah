<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WithdrawResource\Pages;
use App\Filament\Resources\WithdrawResource\Widgets\WithdrawWidget;
use App\Models\Withdraw;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class WithdrawResource extends Resource
{
    protected static ?string $model = Withdraw::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-up-on-square-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Section::make('Payment Method Details')
                            ->schema([
                                Forms\Components\Grid::make(4)
                                    ->schema([
                                        Forms\Components\BelongsToSelect::make('user_id')
                                            ->relationship('user', 'name')
                                            ->label('User')
                                            ->disabled()
                                            ->columnSpan(1),
                                        Forms\Components\TextInput::make('identifier')
                                            ->label('Identifier')
                                            ->disabled()
                                            ->columnSpan(1),

                                        Forms\Components\TextInput::make('amount')
                                            ->label('Amount')
                                            ->disabled()
                                            ->columnSpan(1),

                                        Forms\Components\BelongsToSelect::make('PaymentMethod')
                                            ->relationship('paymentMethod', 'name')
                                            ->label('Payment Method')
                                            ->disabled()
                                            ->columnSpan(1),
                                    ]),
                                ]),

                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\DateTimePicker::make('created_at')
                                        ->label('Requested at')
                                        ->disabled()
                                        ->columnSpan(1),

                                    Forms\Components\DateTimePicker::make('updated_at')
                                        ->label('Last Update')
                                        ->disabled()
                                        ->columnSpan(1),
                                ]),
                    ])
                    ->columns([
                        'sm' => 1,
                        'lg' => 2,
                    ])
                    ->columnSpan('full'),

                Forms\Components\Radio::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'paying' => 'Paying',
                        'paid' => 'Paid',
                        'regected' => 'Rejected',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('paymentMethod.logo_url')
                    ->label('')
                    ->circular(),

                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('amount')
                    ->numeric()
                    ->alignCenter(true)
                    ->badge()
                    ->sortable(),

                Tables\Columns\IconColumn::make('status')
                    ->icon(fn (string $state): string => match ($state) {
                        'pending' => 'heroicon-o-clock',
                        'processing' => 'heroicon-o-cog',
                        'paying' => 'heroicon-o-arrow-path',
                        'paid' => 'heroicon-o-check-badge',
                        'regected' => 'heroicon-o-x-circle',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'processing' => 'primary',
                        'paying' => 'info',
                        'paid' => 'success',
                        'regected' => 'danger',
                    }),

                Tables\Columns\TextColumn::make('identifier')
                    ->color(fn ($record) => $record->identifier ? 'success' : 'danger')
                    ->badge()
                    ->getStateUsing(fn ($record) => $record->identifier ?? 'No Identifier')
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Requested at')
                    ->since()
                    ->sortable(),


                Tables\Columns\TextColumn::make('updated_at')
                ->label('Last Update')
                ->since()
                ->sortable(),
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }


    public static function getWidgets(): array
    {
        return [
            WithdrawWidget::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWithdraws::route('/'),
        ];
    }
}
