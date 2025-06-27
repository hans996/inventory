<?php

namespace App\Http\Livewire;

use App\Models\Position;
use Livewire\Component;

class PositionCreate extends Component
{
    public $name;
    public $role_as;

    public function render()
    {
        return view('livewire.position-create');
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:positions,name|min:3',
            'role_as' => 'nullable'
        ]);

        Position::Create([
            'name' => $this->name,
            'role_as' => $this->role_as == true ? '1':'0',
        ]);

        $this->name = NULL;
        $this->role_as = NULL;

        $this->dispatchBrowserEvent('success', ['message'=>'Jabatan berhasil ditambahkan !']);
        $this->emit('PositionStore');
    }
}
