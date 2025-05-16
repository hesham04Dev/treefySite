<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Language;
use App\Models\LanguageRequest;
use Livewire\WithFileUploads;
class TranslatorProfile extends Component
{
    public $languages;
    public $confirmingLanguageId = null;

    use WithFileUploads;

    public $allLanguages;
    public $showRequestForm = false;
    public $requestLanguageId;
    public $requestReason;
    public $requestFile;

    public function mount()
    {
        $this->loadLanguages();
        $translator = auth()->user()->translator;
        $existingLanguageIds = $translator->languages()->pluck('languages.id');
        
        $this->allLanguages = Language::whereNotIn('id', $existingLanguageIds)->get();
        
        
    }

    public function requestAddLanguage()
    {
        $this->showRequestForm = true;
    }

    public function submitLanguageRequest()
    {
        $this->validate([
            'requestLanguageId' => 'required|exists:languages,id',
            'requestReason' => 'required|string|min:10',
            'requestFile' => 'required|file|max:2048',
        ]);

        $path = $this->requestFile->store('language_requests', 'public');

        LanguageRequest::create([
            'translator_id' => Auth::id(),
            'language_id' => $this->requestLanguageId,
            'reason' => $this->requestReason,
            'file_path' => $path,
        ]);

        $this->reset(['showRequestForm', 'requestLanguageId', 'requestReason', 'requestFile']);
        session()->flash('message', __('done'));
    }

    public function loadLanguages()
    {
        $this->languages = Auth::user()->translator->languages;
    }

    public function confirmRemove($languageId)
    {
        $this->confirmingLanguageId = $languageId;
    }

    public function cancelRemove()
    {
        $this->confirmingLanguageId = null;
    }

    public function removeLanguage()
    {
        if ($this->confirmingLanguageId) {
            Auth::user()->translator->languages()->detach($this->confirmingLanguageId);
            session()->flash('message', __('done'));
            $this->confirmingLanguageId = null;
            $this->loadLanguages();
        }
    }

    public function render()
    {
        return view('livewire.translator-profile');
    }
}
