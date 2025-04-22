<?php

namespace App\Filament\Resources\TranslatorResource\Pages;

use App\Filament\Resources\TranslatorResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTranslator extends CreateRecord
{
    protected static string $resource = TranslatorResource::class;

    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
    //     // Create user first
    //     $user = \App\Models\User::create($data['user']);

    //     // Attach user_id to translator
    //     $data['user_id'] = $user->id;
    //     // $data['translator_id'] = $user->id;

    //     // Remove the nested user data
    //     unset($data['user']);

    //     return $data;
    // }
}
