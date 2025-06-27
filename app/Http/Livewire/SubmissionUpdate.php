<?php

namespace App\Http\Livewire;

use App\Models\Inventory;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SubmissionUpdate extends Component
{
    public $submissionInventoryId;

    public $name;
    public $kode_barang;
    public $jumlah;
    public $keterangan;
    public $jenis;

    public $status;
    public $kode_permintaan;
    public $inventory_id;
    public $user_id;

    protected $listeners = [
        'dataSubmission' => 'showSubmission'
    ];

    public function render()
    {
        return view('livewire.submission-update');
    }


    public function showSubmission($submission)
    {
        $this->jumlah = $submission['jumlah'];
        $this->submissionInventoryId = $submission['inventory_id'];

        $data = Inventory::where('id', $this->submissionInventoryId)->first();
        $this->name = $data['name'];
        $this->keterangan = $data['keterangan'];
        $this->jenis = $data['jenis'];
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255|min:3',
            'jumlah' => 'required|integer|max:9999|min:1',
            'jenis' => 'required|integer|max:99',
            'keterangan' => 'nullable|max:255|min:3'
        ]);

        if($this->submissionInventoryId){
            $inventory = Inventory::where('id', $this->submissionInventoryId)->first();
            $submission = Submission::where('inventory_id', $this->submissionInventoryId)->first();
            $x = $submission['status'];
            $usId = Auth::id();

            if($usId == $submission->user_id && $x == 1){
                $inventory->update([
                    'name' => $this->name,
                    'jumlah' => 0,
                    'keterangan' => $this->keterangan,
                    'jenis' => $this->jenis
                ]);
                $submission->update([
                    'jumlah' => $this->jumlah
                ]);

                $this->removeMe();
                $this->dispatchBrowserEvent('success', ['message'=>'Pengajuan berhasil diubah !']);
            }else{
                $this->dispatchBrowserEvent('warning', ['message'=>'Tindakan ini tidak dapat dilanjutkan !']);
            }
        }
        $this->emit('submissionUpdateStatusFalse');
        $this->emit('SubmissionUpdated');
    }

    public function cancel()
    {
        $this->removeMe();
        $this->emit('submissionUpdateStatusFalse');
    }

    public function removeMe()
    {
        $this->name = NULL;
        $this->jumlah = NULL;
        $this->keterangan = NULL;
        $this->jenis = NULL;
    }
}
