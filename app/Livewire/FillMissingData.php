<?php

namespace App\Livewire;

use App\Models\Language;
use App\Models\Translator;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class FillMissingData extends Component
{
    use WithFileUploads;

    public $is_translator = null;
    public ?Translator $data = null;
    public $cv; // File input
    public $desc;
    public $user;
    public $selectedLanguages =[];
    public $languages = [];

    public function mount()
    {
        $this->user = auth()->user();
        $this->data = new Translator();
        $this->languages = Language::all(); // Fetch languages for dropdown
    }

    public function save()
    {   
        if ($this->is_translator === null) {
            session()->flash('error', 'Please select if you are a translator or not.');
            return;
        }
        if($this->is_translator){

        $this->validate([
            'selectedLanguages' => 'required|array|min:1',
            'selectedLanguages.*' => 'exists:languages,id',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'desc' => 'required|string|min:10',
        ]);

        $cvPath = $this->cv->store('cvs', 'public');
        
        $translator = Translator::create([
            'user_id' => $this->user->id,
            'cv_path' => $cvPath,
            'desc' => $this->desc,
            // 'language_id' => $this->language_id,
        ]);
        $translator->languages()->sync($this->selectedLanguages);}
        $this->user->is_new_user = false;
        $this->user->save();
        session()->flash('success', 'Translator profile created successfully.');
        return redirect()->route('dashboard');
    }
    public function saveUser(){
        $this->is_translator =false;
        return $this->save();
    }
  
        
    public function render()
    {
        return view('livewire.fill-missing-data');
    }
}
