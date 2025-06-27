<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Suplier;



class SuplierCreate extends Component
{
    public $name;
    public $email;
    public $alamat;
    public $telepon;

    public function render()
    {
        return view('livewire.suplier-create');
    }

    public function store(){
        $this->validate([
            'name' => 'required|string|max:255|min:3',
            'alamat' => 'required|string|max:255|min:3',
            'telepon' => 'required|string|max:255|min:3|unique:supliers,telepon',
            'email' => 'nullable|string|email|max:255|unique:supliers,email'
        ]);

        Suplier::Create([
            'name' => $this->name,
            'alamat' => $this->alamat,
            'telepon' => $this->telepon,
            'email' => $this->email ? $this->email : null
        ]);

        $this->name = NULL;
        $this->email = NULL;
        $this->telepon = NULL;
        $this->alamat = NULL;

        $this->dispatchBrowserEvent('success', ['message'=>'Suplier berhasil ditambahkan !']);

        $this->emit('SuplierStore');
    }
}
