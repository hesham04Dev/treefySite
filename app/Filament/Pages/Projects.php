<?php

// namespace App\Filament\Pages;

// use Filament\Pages\Page;

// class Projects extends Page
// {
//     protected static ?string $navigationIcon = 'heroicon-o-document-text';

//     protected static string $view = 'filament.pages.projects';
//     public static function shouldRegisterNavigation(): bool
//     {
//         return false;
//     }

//     use InteractsWithForms;

//     public ?User $data = null;
//     public $cv_path;
//     public $translator_id;

//     public $desc;

//     public function mount()
//     {
        
//         // $this->data = new Translator();
//         // $this->form->fill();
//     }

//     protected function getFormModel(): Translator
//     {
//         return $this->data;
//     }

//     protected function getFormSchema(): array
//     {
//         return TranslatorForm::make(false, false);
//     }

//     public function submit()
//     {
//         $data = $this->form->getState();

//         // $this->data = new Translator();
//         $this->data->user_id = auth()->id();
//         $this->data->desc = $data["desc"];
//         $this->data->cv_path = $data["cv_path"] ?? null; // if you have file upload
//         $this->data->save(); // ✅ Save first to generate ID


//         auth()->user()->is_new_user = false;
//         auth()->user()->save();

//         if (isset($data["translator_id"])) {
//             $this->data->languages()->attach($data["translator_id"]);
//         }


//         // $this->data->fill($data)->save();
//         // session()->flash('success', 'Translator created!');
//         redirect("/dashboard");
//     }


// }
