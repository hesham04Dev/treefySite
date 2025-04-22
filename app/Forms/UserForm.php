<?php

namespace App\Forms;

use Filament\Forms\Components\TextInput;

class UserForm
{
    public static function make($isEmbedded = false): array
    {
        $prefix = "";
        if ($isEmbedded) {
            $prefix = "user.";
        }
        return [
            TextInput::make("{$prefix}name")
                ->label('Name')
                ->required(),

            TextInput::make("{$prefix}email")
                ->label('Email')
                ->email()
                ->required()
                ->unique('users', 'email'),

            TextInput::make("{$prefix}password")
                ->password()
                ->maxLength(255)
                ->dehydrateStateUsing(fn($state) => filled($state) ? bcrypt($state) : null)
                ->required(fn(string $context): bool => $context === 'create')
                ->label('Password')
                ->dehydrated(fn($state) => filled($state)),
        ];
    }
}
