<?php

namespace App\Http\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditProfile extends Component
{
    use WithFileUploads;

    public $avatar;
    public $name;
    public $adress;
    public $telepon;
    public $email;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->adress = $user->adress;
        $this->telepon = $user->telepon;
        $this->email = $user->email;
    }

    public function render()
    {
        return view('livewire.edit-profile');
    }

    public function update()
    {
        $this->validate([
            'avatar' => 'nullable|mimes:jpg,jpeg,png,bmp|max:1024',
            'name' => 'required|string|max:255|min:3',
            'adress' => 'required|string|max:255|min:3',
            'telepon' => 'required|string|max:255|min:3|unique:users,telepon,'.auth()->user()->id,
            'email' => 'string|email|max:255|unique:users,email,'.auth()->user()->id
        ]);

    $user = auth()->user();
    if ($user) {
        if ($user->avatar !== "default.png" && $user->avatar !== $user->avatar) {
            Storage::delete('avatars/' . $user->avatar);
        }

        if ($this->avatar) {
            $extension = $this->avatar->getClientOriginalExtension();
            $avatarName = Carbon::now()->timestamp . '.' . $extension;
            $this->avatar->storeAs('avatars', $avatarName);
        } else {
            $avatarName = $user->avatar;
        }

        $userId = User::find($user->id);
        $userId->update([
            'name' => $this->name,
            'avatar' => $avatarName,
            'adress' => $this->adress,
            'telepon' => $this->telepon,
            'email' => $this->email
        ]);

        $this->removeMe();
        $this->dispatchBrowserEvent('success', ['message'=>'Profile berhasil di update !']);
        $this->emit('userUpdated');
        // return redirect()->to('edit-profile');
        }
    }

    public function resetAvatar()
    {
        $this->avatar = NULL;
    }
    
    public function cancel()
    {
        $this->removeMe();
    }

    private function removeMe()
    {
        $this->name = NULL;
        $this->avatar = NULL;
        // $this->email = NULL;
        $this->telepon = NULL;
        $this->adress = NULL;
    }
}
