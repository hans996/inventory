<?php

namespace App\Http\Livewire;

use App\Models\Submission;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class RequestList extends Component
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
        return view('livewire.request-list',[
            'users' => User::all(),
            'submissions' => Submission::whereHas('inventory', function($q){
                $q->where('name','like','%'.$this->search.'%');
                if ($this->filterPageJenis) {
                    $q->where('jenis', $this->filterPageJenis);
                }
            })
            ->with(['user', 'inventory'])
            ->when($this->filterPageUser,function($query){
                $query->where('user_id', $this->filterPageUser);
            })
            ->when($this->filterPageStatus,function($query){
                $query->where('status', $this->filterPageStatus);
            })
            ->orderBy('updated_at', 'desc')
            ->paginate($this->perPage)->onEachSide(1)
        ]);
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

    public function getSubmission($id)
    {
        $submission = Submission::find($id);
        $this->emit('getRequest', $submission);
    }

    public function getSubmissionS($id)
    {
        $submission = Submission::find($id);
        $this->emit('getRequestS', $submission);
    }

    public function getSubmissionP($id)
    {
        $submission = Submission::find($id);
        $this->emit('getRequestP', $submission);
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function updatingperPage()
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
}
