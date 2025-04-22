<?php

namespace App\Filament\Resources\ImageVerificationResource\Pages;

use App\Filament\Resources\ImageVerificationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditImageVerification extends EditRecord
{
    protected static string $resource = ImageVerificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
