<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Livewire\Component;

class ChangePassword extends Component
{
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    protected $rules = [
        'current_password'              => 'required',
        'new_password'                  => 'required|min:6|confirmed',
        'new_password_confirmation'     => 'required',
    ];

    public function render()
    {
        return view('livewire.user.change-password');
    }

    public function change()
    {
        $this->validate();

        // Check if the current password matches
        if (Hash::check($this->current_password, Auth::user()->password)) {
            // Update the password
            $user = User::findOrFail(Auth::user()->id);
            $user->update([
                'password'  => Hash::make($this->new_password),
            ]);

            session()->flash('status', 'Password successfully updated!');

        } else {
            session()->flash('warning', 'Current password does not match.');

        }
    }
}
