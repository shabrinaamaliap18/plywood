<?php

namespace App\Http\Livewire;

use App\Pesanan;
use App\PesananDetail;
use App\Product;
use App\Ongkir;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductDetail extends Component
{
    public $product, $jumlah_pesanan, $nomor, $O;

    public function mount($id)
    {
        $productDetail = Product::find($id);

        if ($productDetail) {
            $this->product = $productDetail;
        }
     
    }

    public function masukkanKeranjang()
    {
        $this->validate([
            'jumlah_pesanan' => 'required'
        ]);

        //Validasi Jika Belum Login
        if (!Auth::user()) {
            return redirect()->route('login');
        }
        //Menghitung Total Harga
        $total_harga = ($this->jumlah_pesanan * $this->product->jml_ukuran * $this->product->harga) / 1000000000;

        //Ngecek Apakah user punya data pesanan utama yg status nya 0
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

        //mencari harga ongkir (nama lokasi yg sama dg user == nama kota di tabel ongkir)
        $pesanan2 = Pesanan::join('users', 'users.id', 'pesanans.user_id')->where('user_id', Auth::user()->id)->where('status', 0)->first();
        $AlamatSama = Ongkir::join('users', 'ongkir.nama_kota', 'users.lokasi')->where('users.id', Auth::user()->id)->first();
        $hargafix = $AlamatSama->harga_ongkir;

        //Menyimpan / Update Data Pesanan Utama
        //ini jika pesanan masi kosong
        if (empty($pesanan)) {
            $pesanan = Pesanan::create([
                'user_id' => Auth::user()->id,
                'total_harga' => $total_harga + $hargafix,
                'status' => 0,
                'ongkir' => $hargafix,
            ]);

            $pesanan->kode_pemesanan = 'CVMAS-' . rand();
            $pesanan->update();

            //ini kalo udh ada pesanan, jd tinggal update harga pesanan, sblm ditambah bru
        } else {
            $pesanan->total_harga = $pesanan->total_harga + $total_harga;
            $pesanan->update();
        }

        //Meyimpanan Pesanan Detail
        PesananDetail::create([
            'product_id' => $this->product->id,
            'pesanan_id' => $pesanan->id,
            'jumlah_pesanan' => $this->jumlah_pesanan,
            'total_harga' => $total_harga,
        ]);
        $this->emit('masukKeranjang');
        return redirect('/keranjang');
         }

    public function render()
    {
        return view('livewire.product-detail');
    }
}
