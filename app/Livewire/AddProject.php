<?php

namespace App\Livewire;

use App\Models\Project;
use DB;
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
    public $isEdit = false; // true when editing
    public $projectId = null;
    public $project=null;
    public $disableSubmit = false;
    public $project_name = null;
    public $project_description = null;
    public $points_per_word = null;
    public $verifications_per_word =null;

    public $is_disabled =null;

    public function mount()
    {
            if($this->projectId) {
                $this->project = Project::findOrFail($this->projectId);

                if ($this->project) {
                    $this->isEdit = true;
                    $this->project_name = $this->project->name;
                    $this->project_description = $this->project->desc;
                    $this->points_per_word = $this->project->points_per_word;
                    $this->verifications_per_word = $this->project->verification_no;
                    $this->is_disabled = (bool) $this->project->is_disabled; 
                }else{
                    redirect()->route('dashboard')->with('error', 'Project not found.');
                }
            }

            

    }

    public function render()
    {
        return view('livewire.add-project');
    }

    public function import()
    {
        // $this->validate([
        //     'project_name' => 'required|string|max:255',
        //     'project_description' => 'nullable|string|max:1000',
        //     'points_per_word' => 'required|integer|min:0',
        //     'verifications_per_word' => 'required|integer|min:0',
        //     'zip_file' => 'required|file|mimes:zip|max:10240',
        // ]);

        DB::beginTransaction();

        try {
            $project = Project::create([
                'user_id' => auth()->id(),
                'name' => $this->project_name,
                'desc' => $this->project_description,
                'points_per_word' => $this->points_per_word,
                'verification_no' => $this->verifications_per_word,
            ]);

            $tempPath = $this->zip_file->getRealPath();
            $extractPath = storage_path('app/extracted_' . uniqid());

            $zip = new ZipArchive;
            if ($zip->open($tempPath) === TRUE) {
                $zip->extractTo($extractPath);
                $zip->close();
            } else {
                throw new \Exception('Failed to unzip file.');
            }

            $files = collect(File::allFiles($extractPath))
                ->filter(fn($file) => str_ends_with($file->getFilename(), '.json'));

            $verifiedKeys = [];
            $translationsByLang = [];

            foreach ($files as $file) {
                $json = json_decode(file_get_contents($file->getRealPath()), true);
                if (!$json || !is_array($json)) continue;

                $name = pathinfo($file->getFilename(), PATHINFO_FILENAME);

                if ($name === 'verified_translations') {
                    $verifiedKeys = $json;
                } else {
                    $translationsByLang[$name] = $json;
                }
            }

            foreach ($translationsByLang as $langCode => $pairs) {
                $language = Language::firstOrCreate(['code' => $langCode], ['name' => $langCode]);

                foreach ($pairs as $key => $value) {
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

            DB::commit();

            session()->flash('success', 'Import successful!');
            $this->reset(['zip_file', 'project_name', 'project_description', 'points_per_word', 'verifications_per_word']);

        } catch (\Throwable $e) {
            DB::rollBack();
            logger()->error('Import failed: ' . $e->getMessage());
            session()->flash('error', 'Import failed: ' . $e->getMessage());
        }
    }

    // public function update()
    // {
    //     $this->validate([
    //         'project_name' => 'required|string|max:255',
    //         'project_description' => 'nullable|string|max:1000',
    //         'points_per_word' => 'required|integer|min:0',
    //         'verifications_per_word' => 'required|integer|min:0',
    //     ]);

    //     $project = Project::findOrFail($this->projectId);

    //     $project->update([
    //         'name' => $this->project_name,
    //         'desc' => $this->project_description,
    //         'points_per_word' => $this->points_per_word,
    //         'verification_no' => $this->verifications_per_word,
    //     ]);

    //     session()->flash('success', 'Project updated successfully.');
    // }


    public function update()
    {
        $this->validate([
            'project_name' => 'required|string|max:255',
            'project_description' => 'nullable|string|max:1000',
            'points_per_word' => 'required|integer|min:0',
            'verifications_per_word' => 'required|integer|min:0',
            'zip_file' => 'nullable|file|mimes:zip|max:10240',
            'is_disabled' => 'nullable|boolean',
        ]);
    
        $project = Project::findOrFail($this->projectId);
    
        $project->update([
            'name' => $this->project_name,
            'desc' => $this->project_description,
            'points_per_word' => $this->points_per_word,
            'verification_no' => $this->verifications_per_word,
            'is_disabled' => $this->is_disabled,
        ]);
    
        if ($this->zip_file) {
            DB::beginTransaction();
    
            try {
                $tempPath = $this->zip_file->getRealPath();
                $extractPath = storage_path('app/extracted_' . uniqid());
    
                $zip = new ZipArchive;
                if ($zip->open($tempPath) === TRUE) {
                    $zip->extractTo($extractPath);
                    $zip->close();
                } else {
                    throw new \Exception('Failed to unzip file.');
                }
    
                $files = collect(File::allFiles($extractPath))
                    ->filter(fn($file) => str_ends_with($file->getFilename(), '.json'));
    
                $verifiedKeys = [];
                $translationsByLang = [];
    
                foreach ($files as $file) {
                    $json = json_decode(file_get_contents($file->getRealPath()), true);
                    if (!$json || !is_array($json)) continue;
    
                    $name = pathinfo($file->getFilename(), PATHINFO_FILENAME);
    
                    if ($name === 'verified_translations') {
                        $verifiedKeys = $json;
                    } else {
                        $translationsByLang[$name] = $json;
                    }
                }
    
                foreach ($translationsByLang as $langCode => $pairs) {
                    $language = Language::firstOrCreate(['code' => $langCode], ['name' => $langCode]);
    
                    foreach ($pairs as $key => $value) {
                        $translationKey = TranslationKey::firstOrCreate(['value' => $key]);
    
                        $isSkipped = isset($verifiedKeys[$key]) && in_array($langCode, $verifiedKeys[$key]);
    
                        // Check if this translation already exists
                        $existing = Translation::where([
                            'key_id' => $translationKey->id,
                            'language_id' => $language->id,
                            'project_id' => $project->id,
                        ])->exists();
    
                        if (!$existing) {
                            Translation::create([
                                'key_id' => $translationKey->id,
                                'language_id' => $language->id,
                                'project_id' => $project->id,
                                'value' => $value,
                                'skipped' => $isSkipped,
                            ]);
                        }
                    }
                }
    
                DB::commit();
                session()->flash('success', 'Project updated and new translations added.');
                redirect()->route('dashboard');
    
            } catch (\Throwable $e) {
                DB::rollBack();
                logger()->error('Update failed: ' . $e->getMessage());
                session()->flash('error', 'Update failed: ' . $e->getMessage());
            }
        } else {
            session()->flash('success', 'Project updated successfully (no new translations).');
            redirect()->route('dashboard');
        }
    }
    

    public function export(){
        $project = Project::findOrFail($this->projectId);

        $translations = Translation::where('project_id', $project->id)->get();

        $verifiedTranslations = [];
        foreach ($translations as $translation) {
            if ($translation->skipped) {
                $verifiedTranslations[$translation->key->value][] = $translation->language->code;
            }
        }

        $jsonData = [
            'verified_translations' => $verifiedTranslations,
        ];

        foreach ($translations as $translation) {
            if (!isset($jsonData[$translation->language->code])) {
                $jsonData[$translation->language->code] = [];
            }
            $jsonData[$translation->language->code][$translation->key->value] = $translation->value;
        }

        // Create a zip file
        $zipFileName = 'translations_' . time() . '.zip';
        $zipFilePath = storage_path('app/' . $zipFileName);
        $zip = new ZipArchive();
        if ($zip->open($zipFilePath, ZipArchive::CREATE) !== TRUE) {
            throw new \Exception('Could not create zip file.');
        }

        // Add JSON files to the zip
        foreach ($jsonData as $fileName => $data) {
            if (is_array($data)) {
                $zip->addFromString($fileName . '.json', json_encode($data, JSON_PRETTY_PRINT));
            }
        }

        // Close the zip file
        $zip->close();

        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }
}
