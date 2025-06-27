<?php

namespace App\Http\Livewire;

use App\Models\Position;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class PositionList extends Component
{
    use WithPagination;

    public $positionId;

    public $perPage = 10;
    public $search = '';
    public $positionUpdateStatus = false;

    protected $paginationTheme = 'bootstrap';
    
    protected $listeners = [
        'PositionUpdated' => 'render',
        'PositionStore' => 'render'
    ];

    public function render()
    {
        return view('livewire.position-list',[
            'positions' => Position::orderBy('id','desc')
                            ->where('name','like','%'.$this->search.'%')
                            ->paginate($this->perPage)
        ]);
    }

    public function getPosition($id)
    {
        $this->emit('positionUpdateStatus');
        $position = Position::find($id);
        $this->emit('getPosition', $position);
    }

    public function deleteConfirm($id)
    {
        $this->emit('positionUpdateStatusFalse');
        $this->positionId = $id;
    }

    public function destroy()
    {
        $position = Position::where('id', $this->positionId)->first();
        $userIds = User::pluck('position_id')->toArray();
        $xId = $position->id;
        
        if(!in_array($xId, $userIds)){
            $position->delete();

            $this->dispatchBrowserEvent('success', ['message'=>'Jabatan berhasil dihapus !']);
            $this->emit('PositionStore');
        }else{
            $this->dispatchBrowserEvent('warning', ['message'=>'Maaf, Jabatan ini tidak kosong !']);
        }
        $this->positionId = NULL;
    }

    public function cancel()
    {
        $this->positionId = NULL;
    }

    public function updatingperPage()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
