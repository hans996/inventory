<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserProfile extends Component
{

    protected $listeners = [
        'userUpdated' => 'render',
    ];

    public function render()
    {
        return view('livewire.user-profile');
    }
}
