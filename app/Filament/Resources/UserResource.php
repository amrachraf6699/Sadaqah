<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use BladeUI\Heroicons\BladeHeroiconsServiceProvider;
use COM;
use Filament\Actions\ViewAction;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Nette\Utils\ImageColor;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->extraAttributes(['class' => 'bg-gray-50 p-6 rounded-lg shadow'])
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Card::make('Personal Details')
                                    ->extraAttributes(['class' => 'bg-red-50 p-4 rounded-lg'])
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->required()
                                            ->suffixIcon('heroicon-m-user')
                                            ->autofocus(),

                                        Forms\Components\Radio::make('is_admin')
                                            ->label('Is Admin?')
                                            ->boolean()
                                            ->inline()
                                            ->default(true),
                                    ])
                                    ->icon('heroicon-o-user')
                                    ->collapsed(),
                                Forms\Components\Card::make('Login Details')
                                    ->extraAttributes(['class' => 'bg-blue-50 p-4 rounded-lg'])
                                    ->schema([
                                        Forms\Components\TextInput::make('email')
                                            ->required()
                                            ->email()
                                            ->unique(User::class, 'email')
                                            ->suffixIcon('heroicon-m-envelope'),

                                        Forms\Components\TextInput::make('password')
                                            ->required()
                                            ->minLength(8)
                                            ->password()
                                            ->confirmed()
                                            ->suffixIcon('heroicon-m-key')
                                            ->autocomplete('new-password'),

                                        Forms\Components\TextInput::make('password_confirmation')
                                            ->required()
                                            ->suffixIcon('heroicon-m-key')
                                            ->autocomplete(false),
                                    ])
                                    ->icon('heroicon-o-lock-closed')
                                    ->collapsed(),
                            ]),
                        Forms\Components\Card::make()
                            ->extraAttributes(['class' => 'bg-yellow-50 p-4 rounded-lg'])
                            ->schema([
                                Forms\Components\FileUpload::make('profile_picture')
                                    ->label('Profile Picture')
                                    ->image()
                                    ->required()
                                    ->disk('public_path')
                                    ->directory('images/avatars')
                                    ->maxSize(2048)
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif']),
                            ]),
                    ]),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('profile_picture_url')
                    ->label('')
                    ->circular(),

                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('email')
                    ->searchable(),

                TextColumn::make('balance')
                ->badge(function (User $user) {
                    return $user->balance;
                })
                ->color(function (User $user) {
                    return $user->balance > 0 ? 'success' : 'danger';
                })
                ->sortable(),

                IconColumn::make('is_admin')
                    ->label('is Admin')
                    ->icon(function (User $user) {
                        return $user->is_admin ? 'heroicon-s-check-circle' : 'heroicon-s-x-circle';
                    })
                    ->color(function(User $user) {
                        return $user->is_admin ? 'success' : 'danger';
                    })
                    ->sortable(),
            ])
            ->filters([
                Filter::make('balance')
                    ->query(function (Builder $query) {
                        $query->where('balance', '>', 0);
                    })
                    ->label('With Balance'),
                Filter::make('0balance')
                    ->query(function (Builder $query) {
                        $query->where('balance', '<=', 0);
                    })
                    ->label('0 Balance'),

                Filter::make('admin')
                    ->query(function (Builder $query) {
                        $query->where('is_admin', true);
                    })
                    ->label('Admins'),

                Filter::make('not_admin')
                    ->query(function (Builder $query) {
                        $query->where('is_admin', false);
                    })
                    ->label('Not Admins'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make('profile')
                    ->icon('heroicon-o-user')
                    ->label('View Profile')
                    ->url(fn (User $user) => route('profile.show', $user))
                    ->openUrlInNewTab(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            // 'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
