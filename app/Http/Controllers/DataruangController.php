<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Inventory;
use App\Models\Ruang;
use App\Models\Submission;
use App\Models\Suplier;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Livewire\Controllers;



 

class DataruangController extends Controller
{

    public $name;
    public $kode_barang;
    public $suplier_id;
    public $lokasi;
    public $jumlah;
    public $keterangan;
    public $jenis;

 public $rules = [
        'name' => 'required|string|max:255|min:3',
        'kode_barang' => 'nullable|string|max:255|min:1',
     
        'lokasi' => 'required|string|max:255|min:3',
        'jumlah' => 'required|integer|max:9999|min:1',
        'keterangan' => 'nullable|string|max:255|min:3',
        'jenis' => 'required|integer|in:1,2,3'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('ruang');
    }

    public function tambah()
    {
        return view('create-ruang');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Ruang::where('id',$id)->first();
        return view('editRuang')->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $request->validate(
            [
                'name' => 'required',             
                'lokasi' => 'nullable',
                'jumlah' => 'nullable',
                'keterangan' => 'nullable',
                'jenis' => 'required'
            ],
            [
                'name.require' =>'nama wajib di isi',
                'lokasi.require' =>'lokasi wajib di isi',
                'jumlah.require' =>'jumlah wajib di isi',
                'keterangan.require' =>'keterangan wajib di isi',
                'jenis.require' =>'jenis wajib di isi'




            ]
        );
        $data = [
            'name' => $request->name,
            'lokasi' => $request->lokasi,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'jenis' => $request->jenis,
        ];

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

        Ruang:: where ('id', $id)->update($data);
        return redirect()->to ('data-ruang')->with('success', 'Berhasil di ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        
        Ruang::where('id',$id)->delete();
        return redirect()->to('data-ruang')->with('success','Data Ruang Berhasil di Hapus'); 
     
    }
}
