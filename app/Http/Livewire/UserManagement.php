<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UserManagement extends Component
{
    public $userUpdateStatus = false;
    
    protected $listeners = [
        'userUpdateStatusFalse',
        'userUpdateStatus',
        'getUser' => 'data',
    ];

    public function render()
    {
        return view('livewire.user-management');
    }

    public function userUpdateStatus()
    {
        $this->userUpdateStatus = true;
    }
    
    public function userUpdateStatusFalse()
    {
        $this->userUpdateStatus = false;
    }

    public function data($user)
    {
        $this->emit('dataUser', $user);
    }   
}
