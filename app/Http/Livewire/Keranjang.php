<?php

namespace App\Http\Livewire;

use App\Pesanan;
use App\PesananDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Livewire\Component;


class Keranjang extends Component
{
    protected $pesanan;
    protected $pesanan_details = [];
    public $jumlah_pesanan;
    public $notification = null;

    protected $listeners = [
        'updatedNotification'
    ];

    public function mount()
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }
        $this->jumlah_pesanan = Pesanan::join('pesanan_details', 'pesanan_details.pesanan_id', 'pesanans.id')->where('pesanans.user_id', Auth::user()->id)->get('jumlah_pesanan');
        // dd( $this->jumlah_pesanan);

        // CLEAR NOTIFICATION
        $this->notification = null;
    }

    public function destroy($id)
    {
        $pesanan_detail = PesananDetail::find($id);
        if (!empty($pesanan_detail)) {

            $pesanan = Pesanan::where('id', $pesanan_detail->pesanan_id)->first();
            $jumlah_pesanan_detail = PesananDetail::where('pesanan_id', $pesanan->id)->count();
            if ($jumlah_pesanan_detail == 1) {
                $pesanan->delete();
            } else {
                $pesanan->total_harga = $pesanan->total_harga - $pesanan_detail->total_harga;
                $pesanan->update();
            }

            $pesanan_detail->delete();
        }

        $this->emit('masukKeranjang');

        session()->flash('message', 'Pesanan Dihapus');
    }

    public function updatedNotification($data) {
        $this->notification = $data;
        $this->emit('refreshComponent');
    }

    // update keranjang
    public function updates($id)
    {
        $pesanan_detail = PesananDetail::find($id);
        $pesanan_detail->jumlah_pesanan = $request->jumlah_pesanan;
        $pesanan_detail->total_harga = ($this->jumlah_pesanan*$this->product->jml_ukuran*$this->product->harga)/1000000000;
        $pesanan_detail->update();
        // dd($pesanan_detail);

        $this->emit('masukKeranjang');

        // session()->flash('message', 'Update Sukses!');

        // return view('livewire.keranjang');
    }


    public function render()
    {
        if (Auth::user()) {
            $this->pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
            if ($this->pesanan) {
                $this->pesanan_details = PesananDetail::where('pesanan_id', $this->pesanan->id)->get();
            }
        }

        return view('livewire.keranjang', [
            'pesanan' => $this->pesanan,
            'pesanan_details' => $this->pesanan_details
        ]);
    }
}
