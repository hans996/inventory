<?php

namespace App\Http\Livewire;

use App\Models\Inventory;
use App\Models\Submission;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Post;

class InventoryList extends Component
{
    use WithPagination;

    public $name;
    public $kode_barang;
    public $suplier_id;
    public $user_id;
    public $lokasi;
    public $jumlah;
    public $keterangan;
    public $jenis;
    public $created_at;

    public $perPage = 10;
    public $filterPageStatus = null;
    public $filterPageUser = null;
    public $filterPageJenis = null;
    public $search = '';
    
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'RequestUpdated' => 'render'
    ];

    public function render()
    {
        return view('livewire.inventory-list', [
            'inventories' => Inventory::where(function($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                          ->orWhere('kode_barang', 'like', '%' . $this->search . '%');
                })
                ->whereNotNull('kode_barang')
                ->where('kode_barang', '!=', '')
                ->orderBy('updated_at', 'desc')
                ->paginate($this->perPage)
                ->onEachSide(1)
        ]);
    }

    public function detail($id)
    {
        $inventory = Inventory::findOrFail($id);

        $this->kode_barang = $inventory->kode_barang;
        $this->name = $inventory->name;

        // $this->user_id = $inventory->user->name;
        $this->lokasi = $inventory->lokasi;
        $this->jumlah = $inventory->jumlah;
        $this->created_at = Carbon::parse($inventory->created_at)->isoFormat('dddd, D MMMM YYYY[. Jam : ] H:mm', 'ID');

        $this->keterangan = $inventory->keterangan;
        $this->jenis = $inventory->jenis;
    }

    public function generatePdf()
    {
        $data = [
            'inventories' => Inventory::with('submission')
            ->whereNotNull('kode_barang')
            ->take(100)->get(),
            'date' => date('Y-m-d H:i:s')
        ];

        
        $pdf = Pdf::loadView('inventories-pdf', $data);
        $pdf->set_option("isPhpEnabled", true);
        $pdf->setPaper('A4', 'potrait');
        return response()->streamDownload(function() use($pdf){
            echo $pdf->stream();
        }, 'inventories-pdf.pdf');
    }

    public function cancel()
    {
        $this->kode_barang = NULL;
        $this->name = NULL;
        $this->suplier_id = NULL;
        $this->user_id = NULL;
        $this->lokasi = NULL;
        $this->jumlah = NULL;
        $this->created_at = NULL;
        $this->keterangan = NULL;
        $this->jenis = NULL;
    }

    public function destroyer($id) {
        
        $inventory = Inventory::find($id)->delete();
        $inventory->delete();

        return redirect(url('inventory'))->with('success','Data Inventory Berhasil di Hapus'); 
     
    }

    public function show (){
        
    }

    
}
