<?php

namespace App\Filament\Resources\TranslatorResource\Pages;

use App\Filament\Resources\TranslatorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;


class ListTranslators extends ListRecords
{
    protected static string $resource = TranslatorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }


    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'need-accept' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('is_accepted', false)),
            'accepted' => Tab::make()
            ->modifyQueryUsing(fn(Builder $query) => $query->where('is_accepted', true)),
        ];
    }



}
