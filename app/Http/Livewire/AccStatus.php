<?php

namespace App\Http\Livewire;

use App\Models\Inventory;
use App\Models\Submission;
use Livewire\Component;

class AccStatus extends Component
{
    public $requestId;
    public $status;

    protected $listeners = [
        'dataRequest' => 'showRequest',
    ];

    public function render()
    {
        return view('livewire.acc-status');
    }

    public function showRequest($submission){
        $this->requestId = $submission['inventory_id'];
        $data = Submission::where('inventory_id', $this->requestId)->first();
        $this->status = $data['status'];
    }

    public function update(){
        $this->validate([
            'status' => 'required'
        ]);

        $submission = Submission::where('inventory_id', $this->requestId)->first();

        if($submission->status == 1){
            if($this->requestId){
                $submission->update([
                    'status' => 2
                ]);
                $this->dispatchBrowserEvent('success', ['message'=>'Status berhasil diupdate !']);
                $this->emit('RequestUpdated');
            }
        }else{
            $this->dispatchBrowserEvent('warning', ['message'=>'Terjadi kesalahan !']);
        }
    }

    public function cancel(){
        $this->requestId = NULL;
    }
}
