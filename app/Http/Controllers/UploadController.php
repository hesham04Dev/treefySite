<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use App\Models\TranslationKey;
use App\Models\Translation;
use App\Models\Language;

class UploadController extends Controller
{
    public function importZip(Request $request)
    {
        $request->validate([
            'zip_file' => 'required|file|mimes:zip',
        ]);
    
        $zipPath = $request->file('zip_file')->store('temp');
        $zipFullPath = storage_path("app/{$zipPath}");
    
        $zip = new ZipArchive;
        if ($zip->open($zipFullPath) === TRUE) {
            $extractPath = storage_path('app/temp/extracted_' . uniqid());
            $zip->extractTo($extractPath);
            $zip->close();
        } else {
            return back()->withErrors(['Invalid zip file.']);
        }
    
        // Get JSON files
        $files = collect(scandir($extractPath))->filter(fn($f) => str_ends_with($f, '.json'))->values();
    
        $verifiedKeys = [];
        $translationsByLang = [];
    
        foreach ($files as $file) {
            $filePath = $extractPath . '/' . $file;
            $json = json_decode(file_get_contents($filePath), true);
    
            if (!$json || !is_array($json)) {
                continue; // skip invalid JSON
            }
    
            $name = pathinfo($file, PATHINFO_FILENAME);
    
            if ($name === 'verified_keys') {
                $verifiedKeys = $json;
            } else {
                $translationsByLang[$name] = $json; // e.g., 'en' => { "home": "Home", ... }
            }
        }
    
        // Insert all keys and translations
        foreach ($translationsByLang as $langCode => $pairs) {
            $language = Language::where('code', $langCode)->first();
            if (!$language) continue;
    
            foreach ($pairs as $keyValue => $translationText) {
                // Insert key if not exists
                $translationKey = TranslationKey::firstOrCreate(['value' => $keyValue]);
    
                $isSkipped = isset($verifiedKeys[$keyValue]) && in_array($langCode, $verifiedKeys[$keyValue]);
    
                Translation::updateOrCreate([
                    'key_id' => $translationKey->id,
                    'language_id' => $language->id,
                ], [
                    'value' => $translationText,
                    'skipped' => $isSkipped,
                ]);
            }
        }
    
        // Optional: cleanup
        Storage::delete($zipPath);
        \File::deleteDirectory($extractPath);
    
        return back()->with('success', 'Import completed successfully.');
    }
}
