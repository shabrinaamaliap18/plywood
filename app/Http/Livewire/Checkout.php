<?php

namespace App\Http\Livewire;

use App\Pesanan;
use App\PesananDetail;
use App\Product;
use App\Ongkir;
use Illuminate\Http\Response;
use App\User;
use App\Midtrans;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Http\Livewire\Session;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use OngkirSeeder;

class Checkout extends Component
{
    public $total_harga, $nohp, $name, $alamat, $lokasi, $pesanan_user, $uniqode, $product_id;
    protected $pesanan;
    protected $cetakproduct_id;
    protected $user;
    protected $pesanan_details = [];

    public function mount()
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }

        $this->pesanan = auth()->user()->pesanans()->whereStatus(0)->first();

        if(!$this->pesanan) {
            return redirect('/');
        }

        if(!$this->pesanan->uniqode || !$this->pesanan->kode_midtrans) {
            $this->pesanan->uniqode = rand();
            $dataMidtrans = [
                'atasnama' => Auth::user()->name,
                'email' => Auth::user()->email,
                'telepon' => Auth::user()->nohp,
                'amount' => $this->pesanan->total_harga,
                'total' => $this->pesanan->total_harga,
                'order_id' => $this->pesanan->uniqode,
            ];
            $mtr = new Midtrans();
            $hitSnap = $mtr->midtransSnap($dataMidtrans);
            $this->pesanan->kode_midtrans = $hitSnap;
            $this->pesanan->save();
        }

        $this->nama_perusahaan = Auth::user()->name;
        $this->name = Auth::user()->name;
        $this->nohp = Auth::user()->nohp;
        $this->lokasi = Auth::user()->lokasi;
        $this->alamat = Auth::user()->alamat;

        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

        if (!empty($pesanan)) {
            $this->total_harga = $pesanan->total_harga + $pesanan->ongkir;
            // $this->pesanan->update();
        } else {
            return redirect()->route('home');
        }
    }

    public function render()
    {
        $pesanan = auth()->user()->pesanans()->whereStatus(0)->first();
        if(!$pesanan) {
            redirect('/historyy');
        } else {
            $this->trs_check($pesanan->id);
        }

        return view('livewire.checkout', ['pesanan' => $pesanan]);
    }

    public function trs_check($id)
    {
        $mtr = new Midtrans();
        $pesanan = Pesanan::find($id);

        if($pesanan) {
            $kode = $pesanan->uniqode;
            $hit = $mtr->checkTs($kode);
            $dt = Carbon::now();

            if ($hit) {
                if ($hit->status_code != 404) {
                    // return 'sudah';
                    if ($hit->transaction_status == 'settlement') {
                        $pesanan->tanggal_transaksi = $dt;
                        $pesanan->status = 2;
                        $pesanan->save();
                        $pesanan->user->createNotification('Pembayaran <strong>' . $pesanan->uniqode . '</strong> dikonfirmasi.', 'historyy');
                        // return "berhasil";
                        return redirect('/');
                    } else {
                        return 'belum';
                    }
                } else {
                    return 'belum';
                }
            } else {
                return 'belum';
            }
        }
    }

    public function triggerPaymentSuccess()
    {
        Session::put('transaction', 'success');
        return response()->json(['data' => 'success']);
    }
}
