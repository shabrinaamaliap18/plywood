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

        $history2 = History::find($id);
        $history2->status = 5;
        $history2->update();


        session()->flash('message', 'Konfirmasi Sukses!');

        return view('livewire.historyy');
    }

    public function render()
    {
        if (Auth::user()) {
            $this->pesanans = History::join('products', 'histories.product_id', 'products.id')->where('user_id', Auth::user()->id)->where('histories.status', '2')->orWhere('histories.status', '3')->orWhere('histories.status', '4')->get(['histories.id', "product_id", "user_id", 'status', "total_harga", "jumlah_pesanan", "nama", "tanggal_transaksi", "alat_angkut", "ket", 'histories.updated_at']);
        }

        $this->pesanansukses = History::join('products', 'histories.product_id', 'products.id')->where('user_id', Auth::user()->id)->where('histories.status', '5')->get(['histories.id', "product_id", "user_id", 'status', "total_harga", "jumlah_pesanan", "nama", "tanggal_transaksi", "alat_angkut", "ket", 'histories.updated_at']);

        return view('livewire.historyy');
    }
}
