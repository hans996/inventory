<?php

namespace App\Http\Livewire;

use App\Models\Inventory;
use App\Models\Submission;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class SubmissionList extends Component
{
    use WithPagination;

    public $created_at;
    public $updated_at;

    public $name;
    public $user;
    public $kode_barang;
    public $suplier_id;
    public $lokasi;
    public $jumlah;
    public $keterangan;
    public $jenis;

    public $status;
    public $kode_permintaan;

    public $submissionId;
    // public $user_id;
    public $submissionUpdateStatus = false;
    
    public $perPage = 5;
    public $filterPageStatus = null;
    public $filterPageUser = null;
    public $filterPageJenis = null;
    public $search = '';
    
    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'SubmissionUpdated' => 'render',
        'SubmissionStore' => 'render'
    ];

    public function mount()
    {
        $this->filterPageUser = auth()->id();
    }

    public function render()
    {
        return view('livewire.submission-list',[
            'users' => User::all(),
            
            'submissions' => Submission::with(['user', 'inventory'])
                ->whereHas('inventory', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                    if ($this->filterPageJenis) {
                        $q->where('jenis', $this->filterPageJenis);
                    }
                })
                ->whereHas('user', function ($q) {
                    if ($this->filterPageUser) {
                        $q->where('user_id', $this->filterPageUser);
                    }
                })
                ->when($this->filterPageStatus, function ($q) {
                    $q->where('status', $this->filterPageStatus);
                })
                ->orderBy('updated_at', 'desc')
                ->paginate($this->perPage)->onEachSide(1)
        ]);
    }

    public function getSubmission($inventory_id)
    {
        $this->emit('submissionUpdateStatus');
        $submission = Submission::where('inventory_id', $inventory_id)->first();
        $this->emit('getSubmission', $submission);
    }

    public function deleteConfirm($inventory_id)
    {
        $this->submissionId = $inventory_id;
    }

    public function destroy()
    {
        if($this->submissionId){
            $i = Inventory::where('id', $this->submissionId)->first();
            $x = Submission::where('inventory_id', $this->submissionId)->first();
            $usId = Auth::id();
            
            if ($x && $i) {
                $user = $x->user_id;
                $status = $x['status'];

                if ($usId == $user && $status == 1) {
                    $x->delete();
                    $i->delete();
                    $this->dispatchBrowserEvent('success', ['message' => 'Pengajuan berhasil dihapus!']);
                } else {
                    $this->dispatchBrowserEvent('warning', ['message' => 'Tindakan ini tidak dapat dilanjutkan!']);
                }
            }
        }        
        $this->submissionId = NULL;
        
        $this->emit('SubmissionStore');
    }

    public function detail($id)
    {
        $submission = Submission::with('inventory')->find($id);

        $this->kode_permintaan = $submission->kode_permintaan;
        $this->status = $submission->status;
        $this->user = $submission->user->name;
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
        $this->submissionId = NULL;

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

    public function updatingfilterPageUser()
    {
        $this->resetPage();
    }

    public function updatingfilterPageJenis()
    {
        $this->resetPage();
    }

    public function updatingperPage()
    {
        $this->resetPage();
    }
}
