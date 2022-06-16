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
        $pesanan->ongkir = $request->ongkir;
        $pesanan->status = $request->status;
        $pesanan->total_harga = $request->total_harga;
        $pesanan->save();
        return redirect('/pesanan')->with('status', 'Data pesanan Berhasil Diubah!');
    }

    public function updatebayar($id, Request $request, pesanan $pesanan)
    {
        $pesanan = History::find($id);
        $pesanan->status = $request->status;
        $pesanan->total_harga = $request->total_harga;
        $pesanan->save();
        return redirect('/pesanan/bayar')->with('status', 'Data pesanan Berhasil Diubah!');
    }


    public function delete($id)
    {
        $pesanan = pesanan::find($id);
        $pesanan->delete();
        return redirect('/pesanan')->with('status', 'Data pesanan Berhasil Dihapus!');
    }

    public function trash()
    {
        // mengambil data pesanan yang sudah dihapus
        $pesanan = pesanan::onlyTrashed()->get();
        return view('admin.pesanan-trash', ['pesanan' => $pesanan]);
    }

    // restore data pesanan yang dihapus
    public function kembalikan($id)
    {
        $pesanan = pesanan::onlyTrashed()->where('id', $id);
        $pesanan->restore();
        return redirect('/pesanan')->with('status', 'Data pesanan Berhasil Dikembalikan!');
    }

    // restore semua data pesanan yang sudah dihapus
    public function kembalikan_semua()
    {

        $pesanan = pesanan::onlyTrashed();
        $pesanan->restore();

        return redirect('/pesanan')->with('status', 'Data pesanan Berhasil Dikembalikan!');
    }

    // hapus permanen
    public function hapus_permanen($id)
    {
        // hapus permanen data pesanan
        $pesanan = pesanan::onlyTrashed()->where('id', $id);
        $pesanan->forceDelete();

        return redirect('/pesanan/trash')->with('status', 'Data pesanan Berhasil Dihapus!');
    }

    // hapus permanen semua pesanan yang sudah dihapus
    public function hapus_permanen_semua()
    {
        // hapus permanen semua data pesanan yang sudah dihapus
        $pesanan = pesanan::onlyTrashed();
        $pesanan->forceDelete();

        return redirect('/pesanan/trash')->with('status', 'Data pesanan Berhasil Dihapus!');
    }


    public function cari(Request $request)
    {
        $pesanan = pesanan::sortable()->paginate(10);
        $skipped = ($pesanan->currentPage() * $pesanan->perPage()) - $pesanan->perPage();
        // menangkap data pencarian
        $cari = $request->get('cari');
        $pesanan = pesanan::all();

        if ($cari) {
            $pesanan = pesanan::where("nama_pesanan", "like", "%$cari%")->sortable()->paginate(5);
        }



        return view('admin.pesanan', compact('pesanan', 'skipped'));
    }


    public function getSub()
    {
        $pesanan2 = DB::table('pesanan')
            ->where("jabatan", "koordinator")
            ->orWhere("jabatan", "opd dinkes")
            ->orWhere("jabatan", "opd dp5a")
            ->orWhere("jabatan", "opd dkrth")
            ->orWhere("jabatan", "kecamatan")
            ->orWhere("jabatan", "kelurahan")
            ->pluck("nama_pesanan", "id");

        return json_encode($pesanan2);
    }

    public function getKecamatan()
    {
        $kecamatan = DB::table('m_kecamatan')->pluck("nama_kecamatan", "id");

        return view('masterreport.alllaporan-tambah', compact('kecamatan'));
    }


    public function getKelurahan($id)
    {
        $kelurahan = DB::table('m_kelurahan')->where("no_kecamatan", $id)
            ->pluck("nama_kelurahan", "id");

        // dd($kelurahan);
        return json_encode($kelurahan);
    }
}
