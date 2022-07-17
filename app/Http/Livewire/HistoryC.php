<?php

namespace App\Http\Livewire;

use App\HistoryCustom;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class HistoryC extends Component
{
    public $pesanans, $pesanansukses, $history, $material, $material2;


    public function mount()
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }
    }


    public function submit($id)
    {
        $dt = Carbon::now();

        $history2 = auth()->user()->customs()->findOrFail($id);
        $history2->status_cus = 5;
        $history2->tanggal_terima_cus = $dt;
        $history2->save();


        session()->flash('message', 'Konfirmasi Sukses!');

        return view('livewire.history-c');
    }

    public function render()
    {
        if (Auth::user()) {
            $this->pesanans = auth()->user()->customs()->where('status_cus', '>', 1)->where('status_cus', '<', 5)->get() ?? [];
            $this->pesanansukses = auth()->user()->customs()->whereStatus_cus(5)->get() ?? [];
        }

        return view('livewire.history-c');
    }
}

