<?php

namespace App\Http\Livewire;

use App\Models\Inventory;
use App\Models\Submission;
use App\Models\Suplier;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Livewire\Component;

class RuangCreate extends Component
{
    public $name;
    public $lokasi;
    public $jumlah;
    public $keterangan;


    protected $rules = [
        'name' => 'required|string|max:255|min:3',
        'lokasi' => 'required|string|max:255|min:3',
        'jumlah' => 'required|integer|max:9999|min:1',
        'keterangan' => 'nullable|string|max:255|min:3',
    ];

    public function render()
    {
        return view('livewire.ruang-create',[
            // 'supliers' => Suplier::all()
        ]);
    }

    public function ruangs()
    {        
        $this->validate();
        // $uID = IdGenerator::generate(['table' => 'inventories', 'field' => 'kode_barang', 'length' => 8, 'prefix' => 'BX']);
        $jenis = 

        $inventory = new Inventory();
        $inventory->name = $this->name;
        $inventory->user_id = auth()->user()->id;
        // $inventory->kode_barang = $uID;
        // $inventory->suplier_id = $this->suplier_id;
        $inventory->lokasi = $this->lokasi;
        $inventory->jumlah = $this->jumlah;
        $inventory->keterangan = $this->keterangan;
        // $inventory->jenis = $this->jenis;
        
        $inventory->save();

        $this->name = NULL;
        $this->lokasi = NULL;
        $this->jumlah = NULL;
        $this->keterangan = NULL;


        $this->dispatchBrowserEvent('success', ['message'=>'Barang masuk berhasil ditambahkan !']);

        $this->emit('SubmissionStore');
    }
}
