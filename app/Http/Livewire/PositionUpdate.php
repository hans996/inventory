<?php

namespace App\Http\Livewire;

use App\Models\Position;
use Livewire\Component;

class PositionUpdate extends Component
{
    public $positionId;
    public $name;
    public $role_as;

    protected $listeners = [
        'dataPosition' => 'showPosition'
    ];

    public function render()
    {
        return view('livewire.position-update');
    }

    public function showPosition($position)
    {
        $this->positionId = $position['id'];
        $this->name = $position['name'];
        $this->role_as = $position['role_as'];
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|min:3|string|max:255|unique:positions,name,'.$this->positionId
        ]);

        if($this->positionId){
            $position = Position::find($this->positionId);
    
        if ($this->positionId == 1) {
            $role_as = 1;
            $this->dispatchBrowserEvent('warning', ['message'=>'Akses tidak dapat dirubah !']);
        } else {
            $role_as = $this->role_as;
        }

        $position->update([
            'name' => $this->name,
            'role_as' => $role_as
        ]);

            $this->removeMe();
            $this->dispatchBrowserEvent('success', ['message'=>'Jabatan berhasil diubah !']);
            $this->emit('PositionUpdated');
        }else{
            $this->dispatchBrowserEvent('warning', ['message'=>'Terjadi kesalahan !']);
        }
        $this->emit('positionUpdateStatusFalse');
    }

    public function cancel(){
        $this->removeMe();
        $this->emit('positionUpdateStatusFalse');
    }

    private function removeMe()
    {
        $this->name = NULL;
        $this->role_as = NULL;
    }
}
