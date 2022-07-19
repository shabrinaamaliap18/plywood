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
    public $product, $jumlah_pesanan, $nomor, $O, $notification, $notificationType, $alat_angkut;

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

        if(!auth()->user()->lokasi) {
            $this->notification = 'Mohon isi lokasi terlebih dahulu sebelum memesan.';
            $this->notificationType = 'danger';
            return;
        }

        //Menghitung Total Harga
        $total_harga = ($this->jumlah_pesanan * $this->product->jml_ukuran * $this->product->harga) / 1000000000;

        // dd($ak);
        //Ngecek Apakah user punya data pesanan utama yg status nya 0
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        //Menyimpan / Update Data Pesanan Utama
        //ini jika pesanan masi kosong
        if (empty($pesanan)) {
            $pesanan = new Pesanan([
                'user_id' => Auth::user()->id,
                'status' => 0,
                'tanggal_transaksi' => now()
            ]);
            $totalUkuran = 0;
            foreach ($pesanan->pesanan_details as $row) {
                $totalUkuran += $row->product->jml_ukuran;
            }
            $ak = $pesanan->pesanan_details()->sum('jumlah_pesanan') * ($totalUkuran) / 1000000000;
            //ngecek apa jml kubik lebih dri 5
            if ($ak >= 5) {
                $alat_angkut = 'Truk';
            } else {
                $alat_angkut = 'Pickup';
            }
            //mencari harga ongkir (nama lokasi yg sama dg user == nama kota di tabel ongkir sesuai alat angkut)
            $ongkir = Ongkir::where([
                'nama_kota' => auth()->user()->lokasi,
                'alat_angkut' => $alat_angkut,
            ])->first();

            if(!$ongkir) {
                $ongkir = Ongkir::create([
                    'nama_kota' => auth()->user()->lokasi,
                    'alat_angkut' => $alat_angkut,
                ]);
            }

            if($ongkir->harga_ongkir > 0) {} else {

                $this->notification = 'Estimasi harga ongkir anda sedang dihitung oleh admin, tunggu beberapa saat';
                $this->notificationType = 'warning';
                return;
            }
            $tot = floatval($total_harga + $ongkir->harga_ongkir);
            $pesanan->total_harga = $tot;
            $pesanan->ongkir = $ongkir->harga_ongkir;
            $pesanan->alat_angkut = $ongkir->alat_angkut;
            $pesanan->kode_pemesanan = 'CVMAS-' . rand();
            $pesanan = $this->getSnapToken($pesanan, $tot);
            $pesanan->save();

            //Meyimpanan Pesanan Detail
            PesananDetail::create([
                'product_id' => $this->product->id,
                'pesanan_id' => $pesanan->id,
                'jumlah_pesanan' => $this->jumlah_pesanan,
                'harga' => $total_harga,
            ]);
            // dd($this->product->id);


            //ini kalo udh ada pesanan, jd tinggal update harga pesanan, sblm ditambah bru
        } else {
            $details = $pesanan->pesanan_details()->whereProduct_id($this->product->id)->first();

            if (!$details) {
                //Meyimpanan Pesanan Detail
                $data = [
                    'product_id' => $this->product->id,
                    'pesanan_id' => $pesanan->id,
                    'jumlah_pesanan' => (int)$this->jumlah_pesanan,
                    'harga' => $total_harga
                ];

                $details = PesananDetail::create($data);

                // dd(Pesanan::find($pesanan->id));
                $totalUkuran = 0;
                foreach ($pesanan->pesanan_details as $row) {
                    $totalUkuran += $row->product->jml_ukuran;
                }
                $ak = $pesanan->pesanan_details()->sum('jumlah_pesanan') * ($totalUkuran) / 1000000000;
                //ngecek apa jml kubik lebih dri 5
                if ($ak >= 5) {
                    $alat_angkut = 'Truk';
                } else {
                    $alat_angkut = 'Pickup';
                }
                //mencari harga ongkir (nama lokasi yg sama dg user == nama kota di tabel ongkir sesuai alat angkut)
                $ongkir = Ongkir::where([
                    'nama_kota' => auth()->user()->lokasi,
                    'alat_angkut' => $alat_angkut,
                ])->first();

                if(!$ongkir) {
                    $ongkir = Ongkir::create([
                        'nama_kota' => auth()->user()->lokasi,
                        'alat_angkut' => $alat_angkut,
                    ]);
                }

                if($ongkir->harga_ongkir > 0) {} else {
                    $this->notification = 'Estimasi harga ongkir anda sedang dihitung oleh admin, tunggu beberapa saat';
                    $this->notificationType = 'warning';
                    return;
                }
                $pesanan->ongkir = $ongkir->harga_ongkir;
                $pesanan->total_harga = $pesanan->total_harga + $total_harga;
                $pesanan = $this->getSnapToken($pesanan);
                $pesanan->save();
            } else {
                $this->notification = 'Produk sudah ada dikeranjang.';
                $this->notificationType = 'success';
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

    public function getSnapToken($pesanan) {
        $mtr = new \App\Midtrans();
        $uniqode = rand();
        $grandTotal =  floatval($pesanan->total_harga);
        $dataMidtrans = [
            'atasnama' => auth()->user()->name,
            'email' => auth()->user()->email,
            'telepon' => auth()->user()->nohp,
            'total' => $grandTotal,
            'order_id' => $uniqode,
            'amount' => $grandTotal
        ];
        $hitSnap = $mtr->midtransSnap($dataMidtrans);
        $tokenMidtrans = $hitSnap;

        $pesanan->kode_midtrans = $tokenMidtrans;
        $pesanan->uniqode = $uniqode;
        // if ($pesanan->uniqode == NULL) {


        // }

        return $pesanan;
    }
}
