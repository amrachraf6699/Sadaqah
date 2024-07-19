<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentMethodResource\Pages;
use App\Models\PaymentMethod;
use App\Traits\UploadImage;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class PaymentMethodResource extends Resource
{
    use UploadImage;

    protected static ?string $model = PaymentMethod::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Section::make('Payment Method Details')
                            ->schema([
                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->label('Payment Method Name')
                                            ->required()
                                            ->maxLength(255)
                                            ->placeholder('Enter payment method name')
                                            ->columnSpan(1),

                                        Forms\Components\Toggle::make('is_active')
                                            ->label('Active')
                                            ->required()
                                            ->columnSpan(1),
                                    ]),

                                Forms\Components\Textarea::make('description')
                                    ->label('Description')
                                    ->placeholder('Enter description for the payment method')
                                    ->rows(4)
                                    ->columnSpanFull(),
                            ])
                            ->collapsed(),

                        Forms\Components\Section::make('Logo')
                            ->schema([
                                FileUpload::make('logo')
                                    ->label('Upload Logo')
                                    ->acceptedFileTypes(['image/*'])
                                    ->required()
                                    ->disk('public_path')
                                    ->directory('images/payment_methods')
                                    ->imageEditor()
                                    ->image()
                                    ->hint('Supported formats: jpg, png, gif. Maximum size: 2MB'),
                            ])
                            ->collapsed(),
                    ])
                    ->columns([
                        'sm' => 1,
                        'lg' => 2,
                    ])
                    ->columnSpan('full'),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo_url')
                ->label('')
                ->circular(),


                Tables\Columns\TextColumn::make('name')
                    ->searchable(),

                ToggleColumn::make('is_active')
                ->label('Active')
                ->beforeStateUpdated(function (PaymentMethod $record, $state) {
                    if ($record->is_active === $state) {
                        return;
                    }

                    if ($record->is_active) {
                        $record->is_active = false;
                    } else {
                        $record->is_active = true;
                    }
                })
                ->afterStateUpdated(function (PaymentMethod $record, $state) {
                    $record->save();
                }),
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
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListPaymentMethods::route('/'),
            // 'create' => Pages\CreatePaymentMethod::route('/create'),
            // 'edit' => Pages\EditPaymentMethod::route('/{record}/edit'),
        ];
    }

}
