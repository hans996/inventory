<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class EditPassword extends Component
{
    public $current_password;
    public $new_password;
    public $confirm_new_password;

    public function render()
    {
        return view('livewire.edit-password');
    }

    public function update()
    {
        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:3|same:confirm_new_password',
            'confirm_new_password' => 'required|min:3'
        ]);

        if (!Hash::check($this->current_password, Auth::user()->password)) {
            $this->addError('current_password', 'Current password is incorrect.');
            return;
        }

        $user = auth()->user();

        if($user){
            $user = User::find($user->id);

            $user->update([
                'password' => Hash::make($this->new_password)
            ]);
        }
        $this->dispatchBrowserEvent('success', ['message'=>'Password berhasil diubah !']);
        $this->removeMe();
    }

    public function cancel()
    {
        $this->removeMe();
    }

    private function removeMe()
    {
        $this->current_password = NULL;
        $this->new_password = NULL;
        $this->confirm_new_password = NULL;
    }
}
