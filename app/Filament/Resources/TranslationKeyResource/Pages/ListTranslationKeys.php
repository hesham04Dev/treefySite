<?php

namespace App\Filament\Resources\TranslationKeyResource\Pages;

use App\Filament\Resources\TranslationKeyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTranslationKeys extends ListRecords
{
    protected static string $resource = TranslationKeyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
