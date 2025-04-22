<?php

namespace App\Filament\Resources\UpdatedTranslationResource\Pages;

use App\Filament\Resources\UpdatedTranslationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUpdatedTranslations extends ListRecords
{
    protected static string $resource = UpdatedTranslationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
