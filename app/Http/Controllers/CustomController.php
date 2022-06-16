<?php

namespace App\Http\Controllers;

use App\CustomP;
use App\CustomDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class CustomController extends Controller
{
    public function masukCustom(Request $request)
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }
        $custom = CustomP::where('user_id', Auth::user()->id)->where('status_cus', 0)->first();

        if (empty($custom)) {
            CustomP::create([
                'user_id' => Auth::user()->id,
                'status_cus' => 0,
            ]);

            $custom = CustomP::where('user_id', Auth::user()->id)->where('status_cus', 0)->first();
            $custom->kode_pemesanan_cus = 'CVMAS-' . rand();
            $custom->update();
        }

        CustomDetail::create([

            'custom_id' => $custom->id,
            'kategori'  => $request->kategori,
            'material' => $request->material,
            'ukuran' => $request->ukuran,
            'jumlah_pesanan_cus' => $request->jumlah_pesanan_cus,
        ]);

        
        if (Auth::user()) {
            $this->custom = CustomP::where('user_id', Auth::user()->id)->where('status_cus', 0)->first();
            if ($this->custom) {
                $this->custom_details = CustomDetail::where('custom_id', $this->custom->id)->get();
            }
        }

        return redirect()->back()->with('success', 'Custom Produk Sukses! Silahkan cek menu Detail Custom untuk melanjutkan pembayaran.');
    }



}
