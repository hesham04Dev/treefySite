<?php

namespace App\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

class UserTable
{
    public static function make($isEmbedded = false): array
    {
        $prefix = "";
        if ($isEmbedded) {
            $prefix = "user.";
        }
        return [
            TextColumn::make("{$prefix}id")->label("Id")->sortable(),
            TextColumn::make("{$prefix}name")->label("Name")->searchable()->sortable(),
            TextColumn::make("{$prefix}email")->label("Email")->searchable()->sortable(),
            // TextColumn::make("{$prefix}created_at")->label("Created At")->dateTime()->sortable(),
            ToggleColumn::make("{$prefix}is_banned")->label("is banned"),
        ];
    }
}
