<?php

namespace App\Http\Livewire;

use App\Models\Submission;
use Livewire\Component;

class WidgetRequest extends Component
{
    protected $listeners = [
        'RequestUpdated' => 'render'
    ];

    public function render()
    {
        $totalPermintaan = Submission::count();
        $totalPending = Submission::where('status', 1)->count();
        $totalProses = Submission::where('status', 2)->count();
        $totalSelesai = Submission::where('status', 3)->count();

        return view('livewire.widget-request', [
            'permintaan' => $totalPermintaan,
            'pending' => $totalPending,
            'proses' => $totalProses,
            'success' => $totalSelesai
        ]);
    }
}
