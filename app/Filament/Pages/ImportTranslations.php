<?php
// //  TO REMOVE
// namespace App\Filament\Pages;

// use App\Forms\ProjectForm;
// use Filament\Forms;
// use Filament\Pages\Page;
// use Filament\Notifications\Notification;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\File;
// use ZipArchive;
// use App\Models\TranslationKey;
// use App\Models\Translation;
// use App\Models\Language;

// class ImportTranslations extends Page implements Forms\Contracts\HasForms
// {
//     use Forms\Concerns\InteractsWithForms;

//     public $zip_file = null;

//     protected static string $view = 'filament.pages.import-translations';
//     protected static ?string $title = 'Import Translations';

//     public function mount(): void
//     {
//         $this->form->fill();
//     }

//     protected function getFormSchema(): array
//     {
//         return ProjectForm::make();
//     }

//     public function submit()
//     {
//         // Handle multiple file uploads (if any)
//         $this->zip_file = is_array($this->zip_file) ? reset($this->zip_file) : $this->zip_file;

//         // Store the uploaded file temporarily
//         $filename = 'temp_import_' . uniqid() . '.zip';
//         $this->zip_file->storeAs('', $filename, 'local');

//         $tempPath = storage_path("app/{$filename}");
//         $extractPath = storage_path('app/extracted_' . uniqid());

//         $zip = new ZipArchive;
//         if ($zip->open($tempPath) === TRUE) {
//             $zip->extractTo($extractPath);
//             $zip->close();
//         } else {
//             Notification::make()
//                 ->title('Failed to unzip file.')
//                 ->danger()
//                 ->send();
//             return;
//         }

//         // Scan extracted directory
//         $files = collect(scandir($extractPath))
//             ->filter(fn($f) => str_ends_with($f, '.json'))
//             ->values();

//         $verifiedKeys = [];
//         $translationsByLang = [];

//         foreach ($files as $file) {
//             $filePath = $extractPath . '/' . $file;
//             $json = json_decode(file_get_contents($filePath), true);

//             if (!$json || !is_array($json)) {
//                 continue;
//             }

//             $name = pathinfo($file, PATHINFO_FILENAME);

//             if ($name === 'verified_keys') {
//                 $verifiedKeys = $json;
//             } else {
//                 $translationsByLang[$name] = $json;
//             }
//         }

//         foreach ($translationsByLang as $langCode => $pairs) {
//             $language = Language::where('code', $langCode)->first();
//             if (!$language) continue;

//             foreach ($pairs as $key => $value) {
//                 $translationKey = TranslationKey::firstOrCreate(['value' => $key]);

//                 $isSkipped = isset($verifiedKeys[$key]) && in_array($langCode, $verifiedKeys[$key]);

//                 Translation::updateOrCreate(
//                     [
//                         'key_id' => $translationKey->id,
//                         'language_id' => $language->id,
//                     ],
//                     [
//                         'value' => $value,
//                         'skipped' => $isSkipped,
//                     ]
//                 );
//             }
//         }

//         // Cleanup
//         File::deleteDirectory($extractPath);
//         Storage::disk('local')->delete($filename);

//         Notification::make()
//             ->title('Translations imported successfully.')
//             ->success()
//             ->send();

//         // Reset form (clears uploaded file)
//         $this->form->fill();
//     }
// }
