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
    public $customs, $detail_custom, $custom_details;
    public $total_harga, $nohp, $name, $alamat, $lokasi, $pesanan_user, $uniqode, $product_id;
    public $canCheckout;

    public function mount()
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }
        $this->name = Auth::user()->name;
        $this->nohp = Auth::user()->nohp;
        $this->lokasi = Auth::user()->lokasi;
        $this->alamat = Auth::user()->alamat;
        $this->custom_details = [];
        $this->customs = auth()->user()->customs;

    }

    public function cancelOrder($id) {
        $c = CustomP::find($id);
        if($c) {
            $c->custom_details()->delete();
            $c->delete();
        }
    }

    public function render()
    {

        return view('livewire.detail-custom', ['customs' => $this->customs]);
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
