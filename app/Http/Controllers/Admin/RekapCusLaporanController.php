<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\CustomDetail;
use App\CustomP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RekapCusLaporanController extends Controller
{

    public function index()
    {

        $custom = CustomP::join('users', 'customs.user_id', 'users.id')
        ->join('detail_customs', 'detail_customs.custom_id', 'customs.id')->where('customs.status_cus', '5')
        ->get(['customs.total_harga_cus', 'customs.id', 'jumlah_pesanan_cus', "name", "kategori", "material", "tebal", "lebar", "panjang", "nohp", "alamat", "lokasi", "status_cus", "ongkir_cus", "custom_id", 'customs.tanggal_transaksi_cus', "alat_angkut_cus", "ket_cus", "nama_perusahaan"]);
       
        return view('admin.rekapcus', ['custom' => $custom], compact('custom'));
    }

    public function search(Request $request)
    {
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $query = CustomP::join('users', 'customs.user_id', 'users.id')
        ->join('detail_customs', 'detail_customs.custom_id', 'customs.id')->where('customs.status_cus', '5')
        ->select(['customs.total_harga_cus', 'customs.id', 'jumlah_pesanan_cus', "name", "tebal", "lebar", "panjang", "nohp", "alamat", "lokasi", "status_cus", "ongkir_cus", 'customs.tanggal_transaksi_cus', "alat_angkut_cus", "ket_cus", "nama_perusahaan"])
            ->where('tanggal_transaksi_cus', '>=', $fromDate)
            ->where('tanggal_transaksi_cus', '<=', $toDate)
            ->get();

        return view('admin.rekapcus-date', compact('query'));
    }
}