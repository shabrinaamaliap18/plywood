<?php

namespace App\Http\Controllers\Admin;

use App\CustomP;
use App\Http\Controllers\Controller;
use App\CustomDetail;
use App\User;
use App\Ongkir;
use App\Custom;
use App\HistoryCustom;
use App\Http\Livewire\DetailCustom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminCustomController extends Controller
{

    public function index()
    {
        $user = User::all();

        $custom = CustomP::join('users', 'customs.user_id', 'users.id')
            ->join('detail_customs', 'detail_customs.custom_id', 'customs.id')
            ->get(['customs.total_harga_cus', 'customs.id', 'jumlah_pesanan_cus', "name", "kategori", "material", "tebal", "lebar", "panjang", "nohp", "alamat", "lokasi", "status_cus", "ongkir_cus", "custom_id", 'customs.created_at', "alat_angkut_cus", "ket_cus"]);

        $produk = CustomDetail::join('categories', 'detail_customs.kategori', 'categories.id')->join('material', 'detail_customs.material', 'material.id')->join('customs', 'custom_id', '=', 'customs.id')->get();
        // dd($produk);


        return view('admin.custom', ['custom' => $custom], compact('custom', 'produk'));
    }

    public function bayar()
    {
        $custom2 = HistoryCustom::join('users', 'history_custom.user_id', 'users.id')->join('categories', 'history_custom.id_kategori', 'categories.id')->join('material', 'history_custom.id_material', 'material.id')
            ->get(['history_custom.total_harga_cus', 'history_custom.id', 'jumlah_pesanan_cus', "name", "nohp", "alamat", "lokasi", "status_cus", "tanggal_transaksi_cus", "ongkir_cus", "tebal", "lebar", "panjang", "history_custom.updated_at", "alat_angkut_cus", "ket_cus"]);

        $produk = HistoryCustom::join('categories', 'history_custom.id_kategori', 'categories.id')->join('material', 'history_custom.id_material', 'material.id')->get();

        return view('admin.custom-bayar', compact('custom2', 'produk'));
    }

    public function edit($id, CustomP $custom)
    {

        $as = CustomP::find($id);
        $ongkirs = Ongkir::whereNama_kota($as->user->lokasi)->get();
        if($ongkirs->count() <= 0) {
            $ongkirs = Ongkir::all();
        }

        return view('admin.custom-edit', compact('as','ongkirs'));
    }

    public function editbayar($id)
    {

        $custom2 = HistoryCustom::join('users', 'history_custom.user_id', 'users.id')->join('categories', 'history_custom.id_kategori', 'categories.id')->join('material', 'history_custom.id_material', 'material.id')->where('history_custom.id', $id)
            ->get(['history_custom.id', 'history_custom.total_harga_cus', 'jumlah_pesanan_cus', "name", "nohp", "alamat", "lokasi", "status_cus", "nama_kategori", "ongkir_cus", "alat_angkut_cus", "ket_cus", "tanggal_transaksi_cus", "history_custom.updated_at"]);

        return view('admin.custom-editbayar', compact('custom2'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'alat_angkut_cus' => ['required'],
        ]);
        $ongkir = Ongkir::findOrFail(request('alat_angkut_cus'));
        $custom = CustomP::find($id);
        $custom->alat_angkut_cus = $ongkir->alat_angkut;
        $custom->ket_cus = $request->ket_cus;
        $custom->ongkir_cus = $ongkir->harga_ongkir;
        $custom->status_cus = $request->status_cus;
        // $custom->total_harga_cus = $request->total_harga_cus ?? 0;
        $gross_amount = $ongkir->harga_ongkir;
        if (true) {
            foreach ($request->ids as $id) {
                $details = $custom->custom_details()->whereId($id)->firstOrFail();
                $details->harga_cus = $request->{'harga_cus_' . $id} * $details->jumlah_pesanan_cus;
                $details->save();
                $gross_amount += $request->{'harga_cus_' . $id} * $details->jumlah_pesanan_cus;
            }
            $custom->total_harga_cus = $gross_amount;

            $mtr = new \App\Midtrans();
            $uniqode = rand();
            $grandTotal =  floatval($custom->total_harga_cus);
            $dataMidtrans = [
                'atasnama' => $custom->user->name,
                'email' => $custom->user->email,
                'telepon' => $custom->user->nohp,
                'total' => $grandTotal,
                'order_id' => $uniqode,
                'amount' => $grandTotal
            ];

            $sanitizeDetails = $custom->custom_details->map(function($item) {
                return [
                    'id' => $item->id,
                    'price' => ($item->harga_cus) / $item->jumlah_pesanan_cus,
                    'quantity' => $item->jumlah_pesanan_cus,
                    'name' => $item->kategory->nama_kategori
                ];
            })->toArray();
            array_push($sanitizeDetails, [
                'id' => rand()+mt_rand(99,999),
                'price' => $ongkir->harga_ongkir,
                'quantity' => 1,
                'name' => 'Ongkir ke '.$ongkir->nama_kota.' dengan '.$ongkir->alat_angkut
            ]);
            $dataMidtrans['items'] = $sanitizeDetails;

            if ($custom->uniqode == NULL) {
                $hitSnap = $mtr->midtransSnap($dataMidtrans);
                $tokenMidtrans = $hitSnap;

                $custom->kode_midtrans = $tokenMidtrans;
                $custom->uniqode = $uniqode;
            }

            $custom->user->createNotification('Total harga Pesanan Custom sudah diperbarui Admin. Segera lunasi pembayaranmu.', 'detailcustom');
        }

        $custom->save();
        return redirect('/customm')->with('status', 'Data custom Berhasil Diubah!');
    }



}
