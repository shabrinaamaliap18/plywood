<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use App\CustomP;
use App\CustomDetail;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Livewire\Component;

class Custom extends Component
{
    public $product, $nama, $jumlah_pesanan_cus, $ukuran;
    protected $custom_details = [], $kategori, $material;


    public function masukCustom(Request $request)
    {
        $this->validate([
            'jumlah_pesanan_cus' => 'required'
        ]);

        if (!Auth::user()) {
            return redirect()->route('login');
        }

        $custom = CustomP::where('user_id', Auth::user()->id)->where('status_cus', 0)->first();

        if (empty($custom)) {

            CustomP::create([
                'user_id' => Auth::user()->id,
                'status_cus' => 0,
                'tanggal_transaksi_cus' => Carbon::now(),
            ]);
            $custom = CustomP::where('user_id', Auth::user()->id)->where('status_cus', 0)->first();
            $custom->kode_pemesanan_cus = 'CVMAS-' . rand();
            $custom->update();

        }
        
        CustomDetail::create([

            'custom_id' => $custom->id,
            'kategori'  => $this->kategori,
            'material' => $this->material,
            'ukuran' => $this->ukuran,
            'jumlah_pesanan_cus' => $this->jumlah_pesanan_cus,
           
        ]);


        session()->flash('message', 'Custom Produk Sukses! Silahkan cek menu Detail Custom untuk melanjutkan pembayaran.');

        return view('livewire.detail-custom');
    }

    public function render()
    {
        $kategori = DB::table('categories')->pluck("nama_kategori", "id");
        $material = DB::table('material')->pluck("nama_material", "id");


        if (Auth::user()) {
            $this->custom = CustomP::where('user_id', Auth::user()->id)->where('status_cus', 0)->first();
            if ($this->custom) {
                $this->custom_details = CustomDetail::where('custom_id', $this->custom->id)->get();
            }
        }

        return view('livewire.custom', [
            'custom_details' => $this->custom_details
        ], compact('kategori', 'material'));
    }
}
