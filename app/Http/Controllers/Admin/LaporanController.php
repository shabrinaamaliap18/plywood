<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\PesananDetail;
use App\User;
use App\Pesanan;
use App\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{

    public function index()
    {

        $pesanan = Pesanan::join('users', 'pesanans.user_id', 'users.id')->join('pesanan_details', 'pesanan_details.pesanan_id', 'pesanans.id')->join('products', 'pesanan_details.product_id', 'products.id')->where('pesanans.status', '5')
        ->get(['pesanans.total_harga', 'pesanans.id','jumlah_pesanan', "name", "nama", "nohp", "alamat", "lokasi", "status", "ukuran", "nama_perusahaan", "alat_angkut", "ket", "tanggal_transaksi"]);

        // dd($pesanan);
       
        return view('admin.rekap', ['pesanan' => $pesanan], compact('pesanan'));
    }

    public function search(Request $request)
    {
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $query = Pesanan::join('users', 'pesanans.user_id', 'users.id')->join('pesanan_details', 'pesanan_details.pesanan_id', 'pesanans.id')->join('products', 'pesanan_details.product_id', 'products.id')->where('pesanans.status', '5')
        ->select(['pesanans.total_harga', 'pesanans.id','jumlah_pesanan', "name", "nama", "nohp", "alamat", "lokasi", "status", "ukuran", "nama_perusahaan", "alat_angkut", "ket", "tanggal_transaksi"])
        ->where('tanggal_transaksi', '>=', $fromDate)
        ->where('tanggal_transaksi', '<=', $toDate)
        ->get();
        // dd($query);

        return view('admin.rekap-date', compact('query'));
    }
}