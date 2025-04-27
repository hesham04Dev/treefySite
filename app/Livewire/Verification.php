<?php

namespace App\Livewire;

use App\Models\ActiveTranslation;
use App\Models\UpdatedTranslation;
use Livewire\Component;
class Verification extends Component
{
    public ?int $project_id = null;

    public string $editableTranslation = '';

    public $translation = null;

    public $user = null;

    public $allTranslations = [];
    public int $currentIndex = 0;

    public function mount()
    {   
        $this->user = auth()->user();
        $this->loadTranslations();
        $this->loadCurrentTranslation();
    }
    public function render()
    {
        return view('livewire.verification', [
            'translation' => $this->translation,
        ]);
    }

    public function loadTranslations()
    {
       
        $query = $this->user->translator->getTranslationsForVerify();

        if ($this->project_id) {
            $query->where("p.id", $this->project_id);
        }

        $this->allTranslations = $query->limit(50)->get();
    }

    public function loadCurrentTranslation()
    {   
        if (isset($this->allTranslations[$this->currentIndex])) {

            $this->translation = $this->allTranslations[$this->currentIndex];
            $this->editableTranslation = $this->translation->value;
            $this->_setActiveTranslation($this->user->id);

        } else {
            $this->translation = null;
            $this->reload();            
        }
    }

    public function markAsCorrect($translationId)
    {
        $this->_setVerification($translationId);
        $this->_removeActiveTranslation($translationId);
        $this->nextTranslation();
    }

    private function _setVerification($translationId)
    {
        $verification = \App\Models\Verification::create([
            'translator_id' => auth()->user()->id,
            'translation_id' => $translationId,
            'is_correct' => $this->editableTranslation == $this->translation->value,
        ]);
        $this->_setUpdatedTranslation($verification->id);

    }

    private function _setUpdatedTranslation($verificationId)
    {
        if ($this->editableTranslation != $this->translation->value) {
            UpdatedTranslation::create([
                'verification_id' => $verificationId,
                'value' => $this->editableTranslation,
            ]);
        }

    }

    private function _removeActiveTranslation($translationId)
    {
        ActiveTranslation::where('translator_id', auth()->user()->id)
            ->where('translation_id', $translationId)
            ->delete();
    }

    private function _setActiveTranslation($userId)
    {
        $activeTranslation = ActiveTranslation::firstOrNew([
            'translator_id' => $userId,
            'translation_id' => $this->translation->id,
        ]);
        $activeTranslation->locked_at = now();
        $activeTranslation->save();
    }

    public function skip($translationId)
    {
        $this->_removeActiveTranslation($translationId);
        $this->nextTranslation();
    }

    public function nextTranslation()
    {
        $this->currentIndex++;
        $this->loadCurrentTranslation();
    }

    public function reload($forceReloadCurrentTranslation = false)
    {   $reloadCurrentTranslation = false;
        if(($this->currentIndex >= count($this->allTranslations)) && $this->currentIndex > 0){
            $reloadCurrentTranslation = true;
        }
        $this->currentIndex = 0;
        $this->loadTranslations();
        if($forceReloadCurrentTranslation || $reloadCurrentTranslation){
            $this->loadCurrentTranslation();
        }
    }
}
