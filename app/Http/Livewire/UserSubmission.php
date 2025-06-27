<?php

namespace App\Http\Livewire;

use App\Models\Inventory;
use App\Models\Submission;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class UserSubmission extends Component
{
    use WithPagination;
    
    public $perPage = 5;
    public $filterPageStatus = null;
    public $search = '';

    public $created_at;
    public $updated_at;

    public $name;
    public $kode_barang;
    public $suplier_id;
    public $lokasi;
    public $jumlah;
    public $keterangan;
    public $jenis;

    public $status;
    public $kode_permintaan;
    
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $userId = Auth::user()->id;
        $totalItem = Submission::where('user_id', $userId)->count();
        $totalPending = Submission::where('user_id', $userId)
                                    ->where('status', 1)->count();
        $totalProses = Submission::where('user_id', $userId)
                                    ->where('status', 2)->count();
        $totalSuccess = Submission::where('user_id', $userId)
                                    ->where('status', 3)->count();

        return view('livewire.user-submission',[
            'totalItem' => $totalItem,
            'pending' => $totalPending,
            'proses' => $totalProses,
            'selesai' => $totalSuccess,

            'submissions' => Submission::with(['user', 'inventory'])
                ->whereHas('inventory', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                })
                ->where('user_id', auth()->id())
                ->when($this->filterPageStatus, function ($query) {
                    $query->where('status', $this->filterPageStatus);
                })
                ->orderBy('updated_at', 'desc')
                ->paginate($this->perPage)->onEachSide(1)
        ]);
    }

    public function getId($id)
    {
        $submission = Submission::with('inventory')->find($id);

        $this->kode_permintaan = $submission->kode_permintaan;
        $this->status = $submission->status;
        $this->created_at = Carbon::parse($submission->created_at)->isoFormat('dddd, D MMMM YYYY[. Jam : ] H:mm', 'ID');
        $this->updated_at = Carbon::parse($submission->updated_at)->isoFormat('dddd, D MMMM YYYY[. Jam : ] H:mm', 'ID');
        $this->jumlah = $submission->jumlah;
        
        $this->kode_barang = $submission->inventory->kode_barang;
        $this->name = $submission->inventory->name;
        $this->keterangan = $submission->inventory->keterangan;
        $this->jenis = $submission->inventory->jenis;
    }

    public function cancel()
    {
        $this->kode_permintaan = NULL;
        $this->status = NULL;
        $this->created_at = NULL;
        $this->updated_at = NULL;
        $this->jumlah = NULL;
        $this->kode_barang = NULL;
        $this->name = NULL;
        $this->keterangan = NULL;
        $this->jenis = NULL;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingfilterPageStatus()
    {
        $this->resetPage();
    }

    public function updatingperPage()
    {
        $this->resetPage();
    }
}
