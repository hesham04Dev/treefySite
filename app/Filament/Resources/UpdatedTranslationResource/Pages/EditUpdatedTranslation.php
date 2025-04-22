<?php

namespace App\Filament\Resources\UpdatedTranslationResource\Pages;

use App\Filament\Resources\UpdatedTranslationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUpdatedTranslation extends EditRecord
{
    protected static string $resource = UpdatedTranslationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
