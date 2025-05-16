<?php
namespace App\Livewire;

use App;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Language;

class UserProfile extends Component
{
    public $name;
    public $user;

    public $oldPassword;
    public $newPassword;



    public $default_lang;
    public $languages;

    public function mount()
    {
        $this->user = Auth::user();
        $this->name = $this->user->name;
        $this->default_lang = $this->user->default_lang;
        $this->languages = Language::all();
    }



    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'default_lang' => 'nullable|exists:languages,id',
        ]);
        if ($this->default_lang != null && $this->default_lang != $this->user->default_lang) {
            App::setLocale(Language::find( $this->default_lang)->code);
            
        }

        $this->user->update([
            'name' => $this->name,
            'default_lang' => $this->default_lang,
        ]);

        session()->flash('message', __('done'));
    }

    public function updatePassword()
    {
        $this->validate([
            // 'oldPassword' => 'required',
            'newPassword' => 'required|min:8',
        ]);
        if ($this->user->password != null && $this->oldPassword != null) {
            if (!Hash::check($this->oldPassword, $this->user->password)) {
                $this->addError('oldPassword', 'Old password is incorrect.');
                return;
            }
        }
        $this->user->update([
            'password' => Hash::make($this->newPassword),
        ]);

        // Reset fields after successful change
        $this->oldPassword = null;
        $this->newPassword = null;

        session()->flash('message', __('done'));
    }

    public function render()
    {
        return view('livewire.user-profile');
    }
}
