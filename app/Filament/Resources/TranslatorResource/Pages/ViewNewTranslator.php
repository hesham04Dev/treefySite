<?php

namespace App\Filament\Resources\TranslatorResource\Pages;

use App\Filament\Resources\TranslatorResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;

class ViewNewTranslator extends ListRecords
{
    protected static string $resource = TranslatorResource::class;
    protected static ?string $title = 'Pending Translators';

    protected function getTableQuery(): ?Builder
    {
        return parent::getTableQuery()
            ->where('is_accepted', false);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('user.name')->label('Name'),
            TextColumn::make('user.email')->label('Email'),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('accept')
                ->label('Accept')
                ->color('success')
                ->requiresConfirmation()
                ->action(function ($record) {
                    $record->update(['is_accepted' => true]);
                })
                ->visible(fn ($record) => !$record->is_accepted),
        ];
    }
}
