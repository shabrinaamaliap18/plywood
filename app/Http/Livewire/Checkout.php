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
    protected $user;
    protected $pesanan_details = [];

    public function mount()
    {
        if (!Auth::user()) {
            return redirect()->route('login');
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
        // dd($pesanan);
    }


    public function checkout(Request $request)
    {           
        $this->validate([
            'nohp' => 'required',
            'lokasi' => 'required',
            'alamat' => 'required'
        ]);

        //Simpan data baru ke data user
        $user = User::where('id', Auth::user()->id)->first();
        $user->nohp = $this->nohp;
        $user->lokasi = $this->lokasi;
        $user->alamat = $this->alamat;
        $user->update();

        //update data pesanan
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesanan->status = 1;
        $pesanan->update();

        $this->emit('masukKeranjang');

        session()->flash('message', "Sukses Checkout");

        return redirect()->route('history');
    }

    public function render()
    {
        if (Auth::user()) {
           

            $pesanan = Pesanan::join('users', 'pesanans.user_id', 'users.id')->where('user_id', Auth::user()->id)->where('pesanans.status', '0')->first();

            if ($pesanan) {
                $pesanan_details = Pesanan::Where('pesanans.user_id', Auth::user()->id)->first();

                // dd($pesanan_details);

                $tokenMidtrans = null;
                $uniqode = null;
                $clientIdMidtrans = 'SB-Mid-client-Du-q1OsWZmCvVaGp';


                $trigger = 0;
                foreach ($pesanan as $as => $key) {
                    if ($pesanan->total_harga != null && $pesanan->status == '0') {
                        // dd($pesanan);
                        //$data = [];
                        $getUser = User::find($pesanan->user_id)->first();
                        // dd($getUser);
                        if ($getUser) {
                            $uniqode_old = $pesanan->id;

                            $checktrs = $this->trs_check($uniqode_old);
                            // dd($checktrs);

                            //return $checktrs;
                            if ($checktrs == 'belum') {
                                if ($pesanan_details->uniqode == NULL) {
                                    $uniqode = rand();
                                    // dd($uniqode);
                                } else {
                                    $uniqode = $pesanan_details->uniqode;
                                }
                              
                                $grandTotal =  floatval($pesanan->total_harga);
                                $dataMidtrans = [
                                    'atasnama' => Auth::user()->name,
                                    'email' => Auth::user()->email,
                                    'telepon' => Auth::user()->nohp,
                                    'total' => $grandTotal,
                                    'order_id' => $uniqode,
                                    'amount' => $grandTotal
                                ];
                                //get mintrans snap 

                                if ($pesanan_details->uniqode == NULL) {
                                    $mtr = new Midtrans();
                                    $hitSnap = $mtr->midtransSnap($dataMidtrans);
                                    $tokenMidtrans = $hitSnap;
                                    // dd($hitSnap);

                                    $pesananUpdate = Pesanan::join('pesanan_details', 'pesanan_details.pesanan_id', 'pesanans.id')->where('pesanans.user_id', Auth::user()->id)->first(['pesanans.id', 'pesanans.*']);
                                    $pesananUpdate->kode_midtrans = $tokenMidtrans;
                                    $pesananUpdate->uniqode = $uniqode;
                                    $pesananUpdate->save();
                                    // dd($pesananUpdate);


                                } else {
                                    $tokenMidtrans = $pesanan_details->kode_midtrans;
                                    // dd($tokenMidtrans);
                                }
                                //update kode midtrans 
                                // return dd('gagal');
                            }
                        }
                    }
                }
            }
        }

        $pesde = PesananDetail::join('pesanans', 'pesanan_details.pesanan_id', 'pesanans.id')->where('pesanans.user_id', Auth::user()->id)->get();

        $ongkir = Ongkir::get();

        $pesde2 = PesananDetail::join('pesanans', 'pesanan_details.pesanan_id', 'pesanans.id')->join('users', 'pesanans.user_id', 'users.id')->where('pesanans.user_id', Auth::user()->id)->get();
        // dd($pesde2);

        $pesdel = PesananDetail::join('products', 'pesanan_details.product_id', 'products.id')->get();
        // dd($pesdel);

        $pesanan = Pesanan::join('users', 'pesanans.user_id', 'users.id')->where('user_id', Auth::user()->id)->first();
        // dd($pesanan);


        
        //ambil data pesanan
        foreach ($pesde as $pesanan_detail) {
            $check_productID[] = $pesanan_detail->product_id;
            for ($i = 0; $i < count([$check_productID]); $i++) {
                $cetakproduct_id = $check_productID[$i] . ', ';
            }
        }

        if($pesanan->status == 2) {
            DB::table('histories')->insert([
                'user_id' => $pesanan->user_id,
                'total_harga' => $pesanan->total_harga,
                'status' => $pesanan->status,
                'ongkir' => $pesanan->ongkir,
                'tanggal_transaksi' => $pesanan->tanggal_transaksi,
                'jumlah_pesanan' => $pesanan_detail->jumlah_pesanan,
                'alat_angkut' => $pesanan->alat_angkut,
                'ket' => $pesanan->ket,
                'product_id' => $pesanan_detail->product_id
            ]);
        }

     
        $delpesanan_details = PesananDetail::join('pesanans', 'pesanan_details.pesanan_id', 'pesanans.id')->where('status', '2')->where('pesanans.user_id', Auth::user()->id)->delete();

        $delpesanans = Pesanan::join('users', 'pesanans.user_id', 'users.id')->where('user_id', Auth::user()->id)->where('status', '2')->delete();

// , compact('tokenMidtrans', 'clientIdMidtrans', 'uniqode', 'pesde', 'pesdel')
        return view('livewire.checkout', ['pesanan' => $pesanan, 'pesde' => $pesde, 'pesde2' => $pesde2, 'pesdel' => $pesdel, 'ongkir' => $ongkir]);
    }   


    public function trs_check($id)
    {

        $mtr = new Midtrans();
        $pesanan = Pesanan::join('pesanan_details', 'pesanan_details.pesanan_id', 'pesanans.id')->where('pesanans.user_id', Auth::user()->id)->first();
        $kode = $pesanan->uniqode;
        $hit = $mtr->checkTs($kode);
        $dt = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();

        if ($hit) {
            if ($hit->status_code != 404) {
                // return 'sudah';
                if ($hit->transaction_status == 'settlement') {
                    DB::table('pesanans')
                        ->where('uniqode', $kode)
                        ->update(['status' => '2']);
                    // return "berhasil";
                    return redirect('historyy');
                } else {
                    return 'belum';
                }
            } else {
                return 'belum';
            }
        } else {
            return 'belum';
        }


        //return $hit->status_code;

    }

    public function triggerPaymentSuccess()
    {
        Session::put('transaction', 'success');
        return response()->json(['data' => 'success']);
    }
}
