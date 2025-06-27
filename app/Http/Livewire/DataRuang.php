<?php

namespace App\Http\Livewire;

use App\Models\Ruang;
use App\Models\Submission;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class DataRuang extends Component
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
        return view('livewire.data-ruang', [
            'data_ruang' => Ruang::where(function($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                        //   ->orWhere('kode_barang', 'like', '%' . $this->search . '%');
                })
                // ->whereNotNull('kode_barang')
                // ->where('kode_barang', '!=', '')
                // ->orderBy('updated_at', 'desc')
                ->paginate($this->perPage)
                ->onEachSide(1)
        ]);
    }

    public function detail($id)
    {
        $data_ruang = ruang::with('suplier')->find($id);

        $this->kode_barang = $data_ruang->kode_barang;
        $this->name = $data_ruang->name;

        // $this->user_id = $inventory->user->name;
        $this->lokasi = $data_ruang->lokasi;
        $this->jumlah = $data_ruang->jumlah;
        $this->created_at = Carbon::parse($data_ruang->created_at)->isoFormat('dddd, D MMMM YYYY[. Jam : ] H:mm', 'ID');

        $this->keterangan = $data_ruang->keterangan;
        $this->jenis = $data_ruang->jenis;
    }

    public function generatePdf()
    {
        $data = [
            'data_ruang' => Ruang::with('submission')
            ->whereNotNull('kode_barang')
            ->take(100)->get(),
            'date' => date('Y-m-d H:i:s')
        ];

        
        $pdf = Pdf::loadView('data_ruang-pdf', $data);
        $pdf->set_option("isPhpEnabled", true);
        $pdf->setPaper('A4', 'potrait');
        return response()->streamDownload(function() use($pdf){
            echo $pdf->stream();
        }, 'data_ruang-pdf.pdf');
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
}
