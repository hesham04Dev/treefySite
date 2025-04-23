<?php

namespace App\Livewire;

use App\Models\ActiveTranslation;
use App\Models\Translation;
use App\Models\UpdatedTranslation;
use Livewire\Component;
use Livewire\WithPagination;

class Verification extends Component
{
    use WithPagination;

    public ?int $project_id = null;

    public string $editableTranslation = '';

    public $translation = null;

    public function render()
    {
        $user = auth()->user();
        $query = $user->translator->getTranslationsForVerify();

        if ($this->project_id) {
            $query->where("p.id", $this->project_id);
        }


        // Show 1 translation at a time
        $translations = $query->paginate(1);
        $this->translation = $translations->first();
        // $translations = $query->get();
        if (!$translations->isEmpty()) {

            // $translation = Translation::find($translations->first()->translation_id);
            // dd($translation);
            // $translation->active_translators++;
            $activeTranslation = ActiveTranslation::where('translator_id', $user->id)
                ->where('translation_id', $this->translation->translation_id)
                ->first();
            if (!$activeTranslation) {
                ActiveTranslation::create([
                    'translator_id' => $user->id,
                    'translation_id' => $this->translation->translation_id,
                ]);
            } else {
                $activeTranslation->locked_at = now();
                $activeTranslation->save();
            }

            $this->editableTranslation = $this->translation->translation;

            // $translation->save();

        }

        return view('livewire.verification', [
            'translation' => $this->translation, // get the first translation for the current page
            'translations' => $translations, // needed for pagination links
        ]);
    }

    // public function markAsCorrect($translationId)
    // {
    //     Verification::create([
    //         'translator_id' => auth()->user()->id,
    //         'translations_id' => $translationId,
    //         'is_correct' => true,
    //     ]);

    //     $this->nextPage();
    // }

    public function markAsCorrect($translationId)
    {
        // Save updated translation value
        // Translation::where('id', $translationId)->update([
        //     'value' => $this->editableTranslation,
        // ]);
       $verification=   \App\Models\Verification::create([
            'translator_id' => auth()->user()->id,
            'translations_id' => $translationId,
            'is_correct' => $this->editableTranslation == $this->translation->translation,
        ]);

        if($this->editableTranslation != $this->translation->translation){
            UpdatedTranslation::create([
                'verification_id' => $verification->id,
                'value' => $this->editableTranslation,
            ]);
        }

        // Delete from active_translations
        ActiveTranslation::where('translator_id', auth()->user()->id)
            ->where('translation_id', $translationId)
            ->delete();

        $this->nextPage();
    }


    public function skip($translationId)
    {
        // $translation = Translation::find($this->translation_id);
        // // $translation->active_translators--;
        // $translation->save();
        $user = auth()->user();
        $activeTranslation = ActiveTranslation::where('translator_id', $user->id)
            ->where('translation_id', $translationId)
            ->first();
        if ($activeTranslation) {
            $activeTranslation->delete();
        }
        $this->nextPage();
    }
}
