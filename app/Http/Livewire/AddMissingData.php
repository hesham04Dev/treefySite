<?php

namespace App\Http\Livewire;
// use App\Forms\TranslatorForm;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Livewire\Component;
use App\Models\Translator; 
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
// use App\Forms\LangForm;

class AddMissingData extends Component implements Forms\Contracts\HasForms
{
    use InteractsWithForms;

    public ?Translator $data;

    public function mount(): void
    {
        $this->form->fill(); 
    }

    protected function getFormModel(): Translator|string|null
    {
        return $this->data ??= new Translator(); 
    }

    protected function getFormSchema(): array
    {
        return [
            Select::make('translator_id')->relationship('languages', 'code')->searchable()->preload()->multiple()
            // ->createOptionForm(LangForm::make())
            ->required(),
            FileUpload::make('cv_path'),
            Textarea::make('desc')->name("Description")->required(),
        ];
    }

    public function render()
    {
        return view('livewire.add-missing-data');
    }
}
