<?php

namespace App\Filament\Resources\TranslatorResource\Pages;

// use App\Filament\Resources\TranslatorResource;
// use Filament\Actions;
// use Filament\Resources\Pages\ManageRecords;

// class AcceptTranslators extends ManageRecords
// {
//     protected static string $resource = TranslatorResource::class;
// }


use Filament\Pages\Page;
use App\Models\Translator;

class AcceptTranslators extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-user-plus';
    protected static string $view = 'filament.pages.accept-translators';
    protected static ?string $title = 'Accept New Translators';

    public $pendingTranslators;

    public function mount(): void
    {
        $this->pendingTranslators = Translator::where('is_accepted', false)->with(['user', 'languages'])->get();
    }

    public function accept($id)
    {
        $translator = Translator::findOrFail($id);
        $translator->update(['is_accepted' => true]);
        $this->mount(); // refresh list
    }
}
