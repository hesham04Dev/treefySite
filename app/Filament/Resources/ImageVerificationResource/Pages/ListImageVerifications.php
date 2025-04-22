<?php

namespace App\Filament\Resources\ImageVerificationResource\Pages;

use App\Filament\Resources\ImageVerificationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListImageVerifications extends ListRecords
{
    protected static string $resource = ImageVerificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
