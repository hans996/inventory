<?php

namespace App\Http\Livewire;

use App\Models\Inventory;
use App\Models\Submission;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SubmissionCreate extends Component
{
    public $name;
    public $kode_barang;
    public $jumlah;
    public $keterangan;
    public $jenis;

    public $status;
    public $kode_permintaan;
    public $inventory_id;
    public $user_id;

    protected $rules = [
        'name' => 'required|string|max:255|min:3',
        'kode_barang' => 'nullable|string|max:255||unique:inventories,kode_barang',
        'jumlah' => 'required|integer|max:9999|min:1',
        'keterangan' => 'nullable|string|max:255|min3',
        'jenis' => 'required|integer|max:99',

        'status' => 'nullable|integer|max:99',
        'kode_permintaan' => 'nullable|string|max:255|unique:submissions,kode_permintaan',
        'keterangan' => 'nullable|string|max:255|min:3',
        'user_id' => 'nullable|integer',
    ];

    public function render()
    {
        return view('livewire.submission-create');
    }

    public function store()
    {
        $this->validate();
        $uID = IdGenerator::generate(['table' => 'submissions', 'field' => 'kode_permintaan', 'length' => 8, 'prefix' => 'PR']);

        $inventory = new Inventory();

        $inventory->name = $this->name;
        $inventory->kode_barang = null;
        $inventory->jumlah = 0;
        $inventory->keterangan = $this->keterangan;
        $inventory->user_id = auth()->user()->id;
        $inventory->jenis = $this->jenis;
        
        $inventory->save();
        
        $submission = new Submission();
        $submission->status = 1;
        $submission->kode_permintaan = $uID;
        $submission->inventory_id = $inventory->id;
        $submission->user_id = auth()->user()->id;
        $submission->jumlah = $this->jumlah;

        $submission->save();

        $this->name = NULL;
        $this->kode_barang = NULL;
        $this->jumlah = NULL;
        $this->keterangan = NULL;
        $this->jenis = NULL;
        $this->status = NULL;
        $this->kode_permintaan = NULL;
        $this->inventory_id = NULL;
        $this->user_id = NULL;

        $this->dispatchBrowserEvent('success', ['message'=>'Pengajuan berhasil ditambahkan !']);
        $this->emit('SubmissionStore');
    }
}