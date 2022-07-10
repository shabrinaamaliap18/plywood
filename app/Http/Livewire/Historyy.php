<?php

namespace App\Http\Livewire;

use App\History;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use \Barryvdh\DomPDF\Facade\Pdf;

class Historyy extends Component
{
    public $pesanans, $pesanansukses, $history;


    public function mount()
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }
    }

    public function masukSubmit($id)
    {

        $history2 = Pesanan::find($id);
        $history2->status = 5;
        $history2->update();


        session()->flash('message', 'Konfirmasi Sukses!');

        return view('livewire.historyy');
    }

    public function render()
    {
        if (Auth::user()) {
            $this->pesanans = auth()->user()->pesanans()->where('status', '<', 5)->get();
        }

        $this->pesanansukses = auth()->user()->pesanans()->where('status', 5)->get();

        return view('livewire.historyy');
    }
}
