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


    public function Submit($id)
    {
        $history2 = HistoryCustom::find($id);
        $history2->status_cus = 5;
        $history2->update();


        session()->flash('message', 'Konfirmasi Sukses!');

        return view('livewire.history-c');
    }

    public function render()
    {
        if (Auth::user()) {
            $this->pesanans = HistoryCustom::join('categories', 'history_custom.id_kategori', 'categories.id')->join('material', 'history_custom.id_material', 'material.id')->where('user_id', Auth::user()->id)
            ->where('history_custom.status_cus', '2')
            ->orWhere('history_custom.status_cus', '3')
            ->orWhere('history_custom.status_cus', '4')
            ->get(['history_custom.id', 'history_custom.created_at', 'history_custom.tanggal_transaksi_cus','history_custom.updated_at', "user_id" ,'status_cus' ,"total_harga_cus" , "jumlah_pesanan_cus", "nama_kategori", "nama_material", "ukuran_cus"]);

        }
        $this->pesanansukses = HistoryCustom::join('categories', 'history_custom.id_kategori', 'categories.id')->join('material', 'history_custom.id_material', 'material.id')->where('user_id', Auth::user()->id)->where('history_custom.status_cus', '5')->get(['history_custom.id', 'history_custom.tanggal_transaksi_cus', 'history_custom.created_at', 'history_custom.updated_at' , "user_id" ,'status_cus' ,"total_harga_cus" , "jumlah_pesanan_cus", "nama_kategori", "nama_material", "ukuran_cus"]);

        return view('livewire.history-c');
    }
}

