<?php

namespace App\Http\Livewire;

use App\Pesanan;
use App\PesananDetail;
use App\Product;
use App\Ongkir;
use App\OngkirP;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductDetail extends Component
{
    public $product, $jumlah_pesanan, $nomor, $O, $notification, $alat_angkut;

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

        //Menghitung jml kubik
        $ak = ($this->jumlah_pesanan * $this->product->jml_ukuran) / 1000000000;
        // dd($ak);
        //Ngecek Apakah user punya data pesanan utama yg status nya 0
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

        //ngecek apa jml kubik lebih dri 5
        if ($ak >= 5) {
            $alat_angkut = 'Truk';
        } else {
            $alat_angkut = 'Pickup';
        }
        // dd($alat_angkut);

        //mencari harga ongkir (nama lokasi yg sama dg user == nama kota di tabel ongkir sesuai alat angkut)
        if ($alat_angkut == 'Truk') {
            $AlamatSama = Ongkir::whereNama_kota(auth()->user()->lokasi)->first();
            // dd($AlamatSama);
            $hargafix = 0;
            if ($AlamatSama) {
                $hargafix = $AlamatSama->harga_ongkir;
            } else {
                $AlamatSama = OngkirP::whereNama_kota(auth()->user()->lokasi)->first();
                // dd($AlamatSama);
                $hargafix = 0;
                if ($AlamatSama) {
                    $hargafix = $AlamatSama->harga_ongkir;
                } else{
                    return;
                }
            }
        }
        // dd($hargafix, $alat_angkut);

        //Menyimpan / Update Data Pesanan Utama
        //ini jika pesanan masi kosong
        if (empty($pesanan)) {
            $pesanan = Pesanan::create([
                'user_id' => Auth::user()->id,
                'total_harga' => $total_harga + $hargafix,
                'status' => 0,
                'ongkir' => $hargafix,
                'alat_angkut' => $this->alat_angkut,
            ]);
            $pesanan->kode_pemesanan = 'CVMAS-' . rand();
            $pesanan->update();
            // dd($pesanan);
            //Meyimpanan Pesanan Detail
            PesananDetail::create([
                'product_id' => $this->product->id,
                'pesanan_id' => $pesanan->id,
                'jumlah_pesanan' => $this->jumlah_pesanan,
                'total_harga' => $total_harga,
            ]);
            // dd($this->product->id);
            //ini kalo udh ada pesanan, jd tinggal update harga pesanan, sblm ditambah bru
        } else {
            $details = $pesanan->pesanan_details()->whereProduct_id($this->product->id)->first();
            // dd($details);

            if (!$details) {
                //Meyimpanan Pesanan Detail
                PesananDetail::create([
                    'product_id' => $this->product->id,
                    'pesanan_id' => $pesanan->id,
                    'jumlah_pesanan' => $this->jumlah_pesanan,
                    'harga' => $total_harga,
                ]);
                $pesanan->ongkir = $hargafix;
                $pesanan->total_harga = $pesanan->total_harga + $total_harga;
                $pesanan->update();
            } else {
                $this->notification = 'Produk sudah ada dikeranjang.';
                return;
            }
        }


        $this->emit('masukKeranjang');
        return redirect('/keranjang');
    }

    public function render()
    {
        return view('livewire.product-detail');
    }
}
