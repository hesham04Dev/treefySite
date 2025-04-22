<?php

namespace App\Forms;

use Filament\Forms\Components\TextInput;

class LangForm
{
    public static function make($isEmbedded=false): array
    {   
        $prefix ="";
        if($isEmbedded){
            $prefix="languages.";
        }
        return [
            TextInput::make("{$prefix}code")
                ->label('Code')
                ->required()
                ->unique('languages', 'code'),

            TextInput::make("{$prefix}name")
                ->label('Name')
                ->required()
                ->unique('languages', 'name'),
        ];
    }
}
