<?php

namespace App\Forms;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;



class TranslatorForm
{
    public static function make($isEmbedded = false, $for_admin = true): array
    {
        $prefix = "";
        if ($isEmbedded) {
            $prefix = "user.";
        }
        $langs = Select::make('translator_id')
            ->searchable()
            ->preload()
            ->multiple()
            ->required();
        if ($for_admin) {
            $langs->createOptionForm(LangForm::make())
                ->relationship('languages', 'code');
        } else {
            $langs->options(
                \App\Models\Language::pluck('code', 'id') // adjust as needed
            )->reactive();
        }
        return [
            $langs,
            FileUpload::make('cv_path'),
            Textarea::make('desc')->name("Description")->required(),
        ];
    }
}
