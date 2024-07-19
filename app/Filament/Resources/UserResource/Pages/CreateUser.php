<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Traits\UploadImage;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\CreateRecord;
use Filament\Pages\Actions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CreateUser extends CreateRecord
{
    use UploadImage;

    protected static string $resource = UserResource::class;

    protected static bool $canCreateAnother = false;


    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.users.index');
    }

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function beforeSave(array $data): array
    {
        $request = app(Request::class);

        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $data['profile_picture'] = $this->uploadImage($image, 'images/avatars');
        }

        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        $data = $this->beforeSave($data);
        return parent::handleRecordCreation($data);
    }

}
