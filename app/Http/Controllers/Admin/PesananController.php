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

class PesananController extends Controller
{

    public function index()
    {
        $user = User::all();

        $pesanan = Pesanan::join('users', 'pesanans.user_id', 'users.id')
            ->join('pesanan_details', 'pesanan_details.pesanan_id', 'pesanans.id')
            ->join('products', 'pesanan_details.product_id', 'products.id')
            ->get(['pesanans.total_harga', 'jumlah_pesanan', "name", "nama", "nohp", "alamat", "lokasi","ongkir", "alat_angkut", "ket",  "tanggal_transaksi", "status", "pesanan_id"]);

        $create = Pesanan::all()->where('user_id', 'pesanans.user_id', 'users.id');


        return view('admin.pesanan', ['pesanan' => $pesanan], compact('pesanan', 'create'));
    }

    public function bayar()
    {
        $pesanan2 = History::join('users', 'histories.user_id', 'users.id')->join('products', 'histories.product_id', 'products.id')
        ->get(['histories.total_harga', 'histories.id','jumlah_pesanan', "name", "nama", "nohp", "alamat", "lokasi", "ongkir", "status", "alat_angkut", "ket", "tanggal_transaksi", "histories.updated_at"]);
      
        $create2 = History::all();

        return view('admin.pesanan-bayar', compact('pesanan2', 'create2'));
    }

    public function edit($id, pesanan $pesanan)
    {
        
        $pesanan = Pesanan::join('users', 'pesanans.user_id', 'users.id')
            ->join('pesanan_details', 'pesanan_details.pesanan_id', 'pesanans.id')
            ->join('products', 'pesanan_details.product_id', 'products.id')
            ->where('pesanans.id', $id)->get(['pesanans.total_harga', 'jumlah_pesanan', "name", "nama", "nohp", "ongkir", "alamat", "lokasi", "status", "alat_angkut", "ket", "pesanan_id"]);

        return view('admin.pesanan-edit', compact('pesanan'));
    }

    public function editbayar($id, pesanan $pesanan)
    {
      
        $pesanan2 = History::join('users', 'histories.user_id', 'users.id')->join('products', 'histories.product_id', 'products.id')
        ->where('histories.id', $id)->get(['histories.id', 'histories.total_harga', 'jumlah_pesanan', "name", "nama", "nohp", "alamat", "lokasi", "ongkir", "status", "tanggal_transaksi", "alat_angkut", "ket", "histories.updated_at"]);

        return view('admin.pesanan-editbayar', compact('pesanan2'));
    }

    public function update($id, Request $request, pesanan $pesanan)
    {
        $pesanan = Pesanan::find($id);
        $pesanan->alat_angkut = $request->alat_angkut;
        $pesanan->ket = $request->ket;
        $pesanan->status = $request->status;
        $pesanan->save();
        return redirect('/pesanan')->with('status', 'Data pesanan Berhasil Diubah!');
    }

    public function updatebayar($id, Request $request, pesanan $pesanan)
    {
        $pesanan = History::find($id);
        $pesanan->status = $request->status;
        $pesanan->alat_angkut = $request->alat_angkut;
        $pesanan->ket = $request->ket;
        $pesanan->save();
        return redirect('/pesanan/bayar')->with('status', 'Data pesanan Berhasil Diubah!');
    }

    public function delete($id)
    {
        $pesanan = pesanan::find($id);
        $pesanan->delete();
        return redirect('/pesanan')->with('status', 'Data pesanan Berhasil Dihapus!');
    }

    
}
