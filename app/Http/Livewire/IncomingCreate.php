<?php

namespace App\Http\Livewire;

use App\Models\Inventory;
use App\Models\Ruang;
use App\Models\Submission;
use App\Models\Suplier;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Livewire\Component;

class IncomingCreate extends Component
{
    public $name;
    public $kode_barang;
    public $suplier_id;
    public $lokasi;
    public $jumlah;
    public $keterangan;
    public $jenis;

    protected $rules = [
        'name' => 'required|string|max:255|min:3',
        'kode_barang' => 'nullable|string|max:255|min:1',
     
        'lokasi' => 'required|string|max:255|min:3',
        'jumlah' => 'required|integer|max:9999|min:1',
        'keterangan' => 'nullable|string|max:255|min:3',
        'jenis' => 'required|integer|in:1,2,3'
    ];

    public function render()
    {
        return view('livewire.incoming-create',[
            
        ]);
    }

    public function store()
    {        
        $this->validate();

        if(!$this->kode_barang) {
            do {
                if($this->jenis == 1 || $this->jenis == 3) {
                    $this->kode_barang = IdGenerator::generate([
                        'table' => 'inventories', 
                        'field' => 'kode_barang',
                        'length' => 8,
                        'prefix' => 'BX'
                    ]);
                } elseif ($this->jenis == 2) {
                    $this->kode_barang = IdGenerator::generate([
                        'table' => 'ruangs', 
                        'field' => 'kode_barang',
                        'length' => 8,
                        'prefix' => 'RX'
                    ]);
                }
            } while (Inventory::where('kode_barang', $this->kode_barang)->exists() ||
            Ruang::where('kode_barang', $this->kode_barang)->exists());
        }
    
        if ($this->jenis == 1 || $this->jenis == 3) {

            // Simpan ke tabel inventories (Sarana & Lainnya)
            Inventory::create([
                'name' => $this->name,
                'user_id' => auth()->user()->id,
                'kode_barang' => $this->kode_barang,
                'lokasi' => $this->lokasi,
                'jumlah' => $this->jumlah,
                'keterangan' => $this->keterangan,
                'jenis' => $this->jenis,
            ]);
        } elseif ($this->jenis == 2) {

            Ruang::create([
                'name' => $this->name,
                'user_id' => auth()->user()->id,
                'kode_barang' => $this->kode_barang,
                'lokasi' => $this->lokasi,
                'jumlah' => $this->jumlah,
                'keterangan' => $this->keterangan,
                'jenis' => $this->jenis,
            ]);
        }

        $this->reset(['name', 'kode_barang', 'lokasi', 'jumlah', 'keterangan', 'jenis']);

        $this->dispatchBrowserEvent('success', ['message'=>'Barang masuk berhasil ditambahkan !']);

        $this->emit('SubmissionStore');
    }

}
