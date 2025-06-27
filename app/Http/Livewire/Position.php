<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Position extends Component
{
    public $positionUpdateStatus = false;
    
    protected $listeners = [
        'positionUpdateStatus',
        'positionUpdateStatusFalse',
        'getPosition' => 'data'
    ];

    public function render()
    {
        return view('livewire.position');
    }

    public function positionUpdateStatus()
    {
        $this->positionUpdateStatus = true;
    }

    public function positionUpdateStatusFalse()
    {
        $this->positionUpdateStatus = false;
    }

    public function data($position)
    {
        $this->emit('dataPosition', $position);
    } 
}
