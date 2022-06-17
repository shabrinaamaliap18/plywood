<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use App\User;
use App\Midtrans;
use Carbon\Carbon;

use App\CustomDetail;
use App\CustomP;
use Illuminate\Support\Facades\DB;

class DetailCustom extends Component
{
    public $customs, $detail_custom;
    public $total_harga, $nohp, $name, $alamat, $lokasi, $pesanan_user, $uniqode, $product_id;

    public function mount()
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }
        $this->name = Auth::user()->name;
        $this->nohp = Auth::user()->nohp;
        $this->lokasi = Auth::user()->lokasi;
        $this->alamat = Auth::user()->alamat;


    }

    public function render()
    {

        if (Auth::user()) {
            $custom = CustomP::join('users', 'customs.user_id', 'users.id')->where('user_id', Auth::user()->id)->where('status_cus', 0)->first();

            if ($custom) {
                $detail_custom = CustomP::where('customs.user_id', Auth::user()->id)->first();

                $tokenMidtrans = null;
                $uniqode = null;


                $trigger = 0;
                foreach ($custom as $as => $key) {

                    if ($custom->total_harga_cus != null && $custom->status_cus == '0') {

                        $getUser = User::find($custom->user_id)->first();

                        if ($getUser) {
                            $uniqode_old = $custom->id;

                            $checktrs = $this->trs_check($uniqode_old);

                            if ($checktrs == 'belum') {
                                if ($detail_custom->uniqode == NULL) {
                                    $uniqode = rand();

                                } else {
                                    $uniqode = $detail_custom->uniqode;
                                }


                                $grandTotal =  floatval($custom->total_harga_cus);
                                $dataMidtrans = [
                                    'atasnama' => Auth::user()->name,
                                    'email' => Auth::user()->email,
                                    'telepon' => Auth::user()->nohp,
                                    'total' => $grandTotal,
                                    'order_id' => $uniqode,
                                    'amount' => $grandTotal
                                ];
                                // dd($grandTotal);

                                if ($detail_custom->uniqode == NULL) {
                                    $mtr = new Midtrans();
                                    $hitSnap = $mtr->midtransSnap($dataMidtrans);
                                    $tokenMidtrans = $hitSnap;

                                    $customUpdate = CustomP::join('detail_customs', 'detail_customs.custom_id', 'customs.id')->where('customs.user_id', Auth::user()->id)->first(['customs.id', 'customs.*']);

                                    $customUpdate->kode_midtrans = $tokenMidtrans;
                                    $customUpdate->uniqode = $uniqode;
                                    $customUpdate->save();
                                } else {
                                    $tokenMidtrans = $detail_custom->kode_midtrans;

                                }

                            }
                        }
                    }
                }
            }
        }

        $custom = CustomP::join('users', 'customs.user_id', 'users.id')->where('user_id', Auth::user()->id)->where('status_cus', 0)->first();

        $detail_custom = CustomDetail::join('customs', 'detail_customs.custom_id', 'customs.id')->where('customs.user_id', Auth::user()->id)->get();

        $pesanan = CustomP::join('users', 'customs.user_id', 'users.id')->where('user_id', Auth::user()->id)->first();

        foreach ($detail_custom as $pesanan_detail) {
            $check_productID[] = $pesanan_detail->id_kategori;
            for ($i = 0; $i < count([$check_productID]); $i++) {
                $cetakproduct_id = $check_productID[$i] . ', ';
            }
        }
        if($pesanan && $pesanan->status_cus == 2) {
            DB::table('history_custom')->insert([
                'user_id' => $pesanan->user_id,
                'total_harga_cus' => $pesanan->total_harga_cus,
                'status_cus' => $pesanan->status_cus,
                'ongkir_cus' => $pesanan->ongkir_cus,
                'tanggal_transaksi_cus' => $pesanan->tanggal_transaksi_cus,
                'jumlah_pesanan_cus' => $pesanan_detail->jumlah_pesanan_cus,
                'alat_angkut_cus' => $pesanan_detail->alat_angkut_cus,
                'ket_cus' => $pesanan_detail->ket_cus,
                'ukuran_cus' => $pesanan_detail->ukuran,
                'id_kategori' => $pesanan_detail->kategori,
                'id_material' => $pesanan_detail->material,
            ]);
        } else {
            abort(404);
        }

        $delpesanan_details = CustomDetail::join('customs', 'detail_customs.custom_id', 'customs.id')->where('status_cus', '2')->where('customs.user_id', Auth::user()->id)->delete();

        $delpesanans = CustomP::join('users', 'customs.user_id', 'users.id')->where('user_id', Auth::user()->id)->where('status_cus', '2')->delete();

        $customs = CustomDetail::join('customs', 'detail_customs.custom_id', 'customs.id')->where('customs.user_id', Auth::user()->id)->get();

        if (Auth::user()) {
            $this->customs = CustomP::where('user_id', Auth::user()->id)->where('status_cus', 0)->first();
            if ($this->customs) {
                $this->custom_details = CustomDetail::join('customs', 'detail_customs.custom_id', 'customs.id')->join('categories', 'detail_customs.kategori', 'categories.id')->where('status_cus', '0')->where('customs.user_id', Auth::user()->id)->where('custom_id', $this->customs->id)->get();
            }
        }
        return view('livewire.detail-custom', ['customs' => $this->customs, 'custom_details' => $this->custom_details, 'detail_custom' => $this->detail_custom, 'custom' => $custom]);
    }


    public function trs_check($id)
    {

        $mtr = new Midtrans();

        $custom = CustomP::join('detail_customs', 'detail_customs.custom_id', 'customs.id')->where('customs.user_id', Auth::user()->id)->first();

        $kode = $custom->uniqode;
        $hit = $mtr->checkTs($kode);
        $dt = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();

        if ($hit) {
            if ($hit->status_code != 404) {

                if ($hit->transaction_status == 'settlement') {

                    CustomP::join('users', 'customs.user_id', 'users.id')->where('user_id', Auth::user()->id)->where('uniqode', $kode)
                        ->update(['status_cus' => '2']);

                    return redirect('historyc');
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

    public function triggerPaymentSuccess()
    {
        Session::put('transaction', 'success');
        return response()->json(['data' => 'success']);
    }
}
