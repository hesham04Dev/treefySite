<?php
namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfile extends Component
{
    public $name;
    public $user;

    public $oldPassword;
    public $newPassword;

    public function mount()
    {
        $this->user = Auth::user();
        $this->name = $this->user->name;
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        $this->user->update([
            'name' => $this->name,
        ]);

        session()->flash('message', 'Profile updated successfully.');
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

        session()->flash('message', 'Password updated successfully.');
    }

    public function render()
    {
        return view('livewire.user-profile');
    }
}
