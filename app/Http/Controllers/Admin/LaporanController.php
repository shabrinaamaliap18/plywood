<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\PesananDetail;
use App\User;
use App\Pesanan;
use App\CustomP;
use App\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{

    public function index()
    {
        $pesanans = Pesanan::with('user')->where('status', '>', 5);
        $customs = CustomP::query()->with('user')->where('status_cus', '>', 5);

        $pesanans->when(request('fromDate') && request('toDate'), function($query) {
            $query->whereBetween('created_at', [request('fromDate'),request('toDate')]);
        });
        $customs->when(request('fromDate') && request('toDate'), function($query) {
            $query->whereBetween('created_at', [request('fromDate'), request('toDate')]);
        });

        $pesanan = $pesanans->get();
        $custom = $customs->get();
        foreach($custom as $row) {
            $pesanan->push($row);
        }
        return view('admin.rekap', compact('pesanan','custom'));
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
