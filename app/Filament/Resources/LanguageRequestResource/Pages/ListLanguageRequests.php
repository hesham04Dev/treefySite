<?php

namespace App\Filament\Resources\LanguageRequestResource\Pages;

use App\Filament\Resources\LanguageRequestResource;

use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListLanguageRequests extends ListRecords
{
    protected static string $resource = LanguageRequestResource::class;

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
            'need-approve' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('is_approved', false)),
            'approved' => Tab::make()
            ->modifyQueryUsing(fn(Builder $query) => $query->where('is_approved', true)),
        ];
    }
}
