<?php

namespace App\Filament\Resources\TranslationKeyResource\Pages;

use App\Filament\Resources\TranslationKeyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTranslationKey extends EditRecord
{
    protected static string $resource = TranslationKeyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
