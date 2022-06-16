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

class RekapLaporanController extends Controller
{

    public function index()
    {

        $pesanan = History::join('users', 'histories.user_id', 'users.id')->join('products', 'histories.product_id', 'products.id')->where('histories.status', '5')
        ->get(['histories.total_harga', 'histories.id','jumlah_pesanan', "name", "nama", "nohp", "alamat", "lokasi", "status", "tanggal_transaksi", "nama_perusahaan", "ukuran","alat_angkut", "ket", "histories.updated_at"]);
       
        return view('admin.rekap', ['pesanan' => $pesanan], compact('pesanan'));
    }

    public function search(Request $request)
    {
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $query = History::join('users', 'histories.user_id', 'users.id')->join('products', 'histories.product_id', 'products.id')->where('histories.status', '5')
        ->select(['histories.total_harga', 'histories.id','jumlah_pesanan', "name", "nama", "nohp", "alamat", "lokasi", "status", "ukuran", "nama_perusahaan", "alat_angkut", "ket", "tanggal_transaksi", "histories.updated_at"])
            ->where('tanggal_transaksi', '>=', $fromDate)
            ->where('tanggal_transaksi', '<=', $toDate)
            ->get();

        $history = History::all();
        return view('admin.rekap-date', compact('history', 'query'));
    }
}