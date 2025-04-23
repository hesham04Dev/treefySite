<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use ZipArchive;
use App\Models\TranslationKey;
use App\Models\Translation;
use App\Models\Language;

class AddProject extends Component
{
    use WithFileUploads;

    public $zip_file;
    public $project_name;
    public $project_description;
    public $points_per_word;
    public $verifications_per_word; 

    public function render()
    {
        return view('livewire.add-project');
    }

    public function import()
    {
        $this->validate([
            'project_name' => 'required|string|max:255',
            'project_description' => 'nullable|string|max:1000',
            'points_per_word' => 'required|integer|min:0',
            'verifications_per_word' => 'required|integer|min:0',
            'zip_file' => 'required|file|mimes:zip|max:10240', // 10MB max file size
        ]);
             
        $project =  Project::create([
            'user_id' => auth()->id(),
            'name' => $this->project_name,
            'desc' => $this->project_description,
            'points_per_word' => $this->points_per_word,
            'verification_no' => $this->verifications_per_word,
        ]);

        logger()->info("Importing translations...");

        // $this->zip_file = is_array($this->zip_file) ? reset($this->zip_file) : $this->zip_file;

        // $filename = 'temp_import_' . uniqid() . '.zip';
        // $this->zip_file->storeAs('', $filename, 'local');

        // $tempPath = storage_path("app/{$filename}");

        $tempPath = $this->zip_file->getRealPath(); // Directly from the Livewire upload

        $extractPath = storage_path('app/extracted_' . uniqid());

        $zip = new ZipArchive;
        if ($zip->open($tempPath) === TRUE) {
            $zip->extractTo($extractPath);
            $zip->close();
        } else {
            session()->flash('error', 'Failed to unzip file.');
            return;
        }

        // $files = collect(scandir($extractPath))
        //     ->filter(fn($f) => str_ends_with($f, '.json'))
        //     ->values();

        $files = collect(File::allFiles($extractPath))
            ->filter(fn($file) => str_ends_with($file->getFilename(), '.json'));

        logger()->info("Files: " . json_encode($files));

        $verifiedKeys = [];
        $translationsByLang = [];

        // foreach ($files as $file) {

        //     $filePath = $extractPath . '/' . $file;
        //     $json = json_decode(file_get_contents($filePath), true);
        //     logger()->info("File: " . $file);
        //     if (!$json || !is_array($json))
        //         continue;

        //     $name = pathinfo($file, PATHINFO_FILENAME);

        //     if ($name === 'verified_keys') {
        //         $verifiedKeys = $json;
        //     } else {
        //         $translationsByLang[$name] = $json;
        //     }
        // }

        foreach ($files as $file) {
            $filePath = $file->getRealPath();
            $json = json_decode(file_get_contents($filePath), true);
        
            if (!$json || !is_array($json)) continue;
        
            $name = pathinfo($file->getFilename(), PATHINFO_FILENAME);
        
            if ($name === 'verified_translations') {
                $verifiedKeys = $json;
            } else {
                $translationsByLang[$name] = $json;
            }
        }
        

        logger()->info("Verified keys: " . json_encode($verifiedKeys));
        logger()->info("Translations: " . json_encode($translationsByLang));
        foreach ($translationsByLang as $langCode => $pairs) {
            $language = Language::where('code', $langCode)->first();
            if (!$language) {
                logger()->info("Language not found: " . $langCode);
                continue;
            }

            foreach ($pairs as $key => $value) {
                logger()->info("$key , $value " . $langCode);
                $translationKey = TranslationKey::firstOrCreate(['value' => $key]);

                $isSkipped = isset($verifiedKeys[$key]) && in_array($langCode, $verifiedKeys[$key]);

                Translation::updateOrCreate(
                    [
                        'key_id' => $translationKey->id,
                        'language_id' => $language->id,
                        'project_id' => $project->id,
                    ],
                    [
                        'value' => $value,
                        'skipped' => $isSkipped,
                    ]
                );
            }
        }

        File::deleteDirectory($extractPath);
        Storage::disk('local')->delete($this->zip_file->hashName());

        session()->flash('success', 'Translations imported successfully.');

        $this->reset('zip_file');
    }
}
