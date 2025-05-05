<?php

namespace App\Filament\Resources\LanguageRequestResource\Pages;

use App\Filament\Resources\LanguageRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLanguageRequest extends EditRecord
{
    protected static string $resource = LanguageRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
