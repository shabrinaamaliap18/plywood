<?php

namespace App\Http\Livewire;

use App\Liga;
use App\Categories;
use App\Pesanan;
use App\PesananDetail;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navbar extends Component
{
    public $jumlah = 0;

    protected $listeners = [
        'masukKeranjang' => 'updateKeranjang'
    ];

    public function updateKeranjang()
    {
        if(Auth::user()) {
            $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
            if($pesanan) {
                $this->jumlah = PesananDetail::where('pesanan_id', $pesanan->id)->count();
            }else {
                $this->jumlah = 0;
            }
        }
    }
    public function handleNotification($id) {
        $n = \App\Notification::find($id);
        $n->read_at = now();
        $n->save();
        if($n) {
            if($n->link) {
                return redirect($n->link);
            }
        }
        return redirect('/');
    }

    public function mount()
    {
        if(Auth::user()) {
            $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
            if($pesanan) {
                $this->jumlah = PesananDetail::where('pesanan_id', $pesanan->id)->count();
            }else {
                $this->jumlah = 0;
            }
        }

    }

    public function render()
    {
        return view('livewire.navbar',[
            'categories' => Categories::all(),
            'jumlah_pesanan' => $this->jumlah,
        ]);
    }
}
