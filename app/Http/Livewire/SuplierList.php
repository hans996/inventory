<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Suplier;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\WithPagination;


class SuplierList extends Component
{
    use WithPagination;

    public $suplierId;
    public $suplierUpdateStatus = false;
    public $perPage = 10;
    public $search = '';
    
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'SuplierUpdated' => 'render',
        'SuplierStore' => 'render'
    ];

    public function render()
    {
        return view('livewire.suplier-list', [
            'supliers' => Suplier::orderBy('id','desc')->where('name','like','%'.$this->search.'%')->paginate($this->perPage)->onEachSide(1)
        ]);
    }

    // public function deleteConfirm($id){
    //     $this->emit('suplierUpdateStatusFalse');
    //     $this->suplierId = $id;
    // }

    // public function destroy()
    // {
    //     $suplier = Suplier::where('id', $this->suplierId)->first();
    //     $suplier->delete();

    //     $this->suplierId = NULL;

    //     $this->dispatchBrowserEvent('success', ['message'=>'Suplier berhasil dihapus !']);
    //     $this->emit('SuplierStore');
    // }

    public function getSuplier($id)
    {
        $this->emit('suplierUpdateStatus');
        $suplier = Suplier::find($id);
        $this->emit('getSuplier', $suplier);
    }

    public function generatePdf()
    {
        $data = [
            'supliers' => Suplier::all(),
            'date' => date('Y-m-d H:i:s')
        ];

        
        $pdf = Pdf::loadView('supliers-pdf', $data);
        $pdf->set_option("isPhpEnabled", true);
        $pdf->setPaper('A4', 'potrait');
        return response()->streamDownload(function() use($pdf){
            echo $pdf->stream();
        }, 'supliers.pdf');
    }

    public function cancel()
    {
        $this->suplierId = NULL;
    }
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function updatingperPage()
    {
        $this->resetPage();
    }
}
