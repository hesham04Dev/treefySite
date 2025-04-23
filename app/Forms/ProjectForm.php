<?php

namespace App\Forms;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class ProjectForm
{
    public static function make($isEmbedded = false): array
    {
       
        return [
            TextInput::make('name')
                ->required()
                ->maxLength(255),
            Textarea::make('desc')
                ->columnSpanFull(),
            TextInput::make('points_per_word')
                ->required()
                ->numeric()
                ->default(1),
            TextInput::make('verification_no')
                ->required()
                ->numeric()
                ->default(2),
            FileUpload::make('zip_file')
                ->label('Translation ZIP File')
                ->acceptedFileTypes(['application/zip'])
                ->required()
                // ->directory('uploads')
                // ->storeFiles(),
        ];
    }
}

