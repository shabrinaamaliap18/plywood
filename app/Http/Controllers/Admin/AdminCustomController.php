<?php

namespace App\Http\Controllers\Admin;

use App\CustomP;
use App\Http\Controllers\Controller;
use App\CustomDetail;
use App\User;
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
            ->get(['customs.total_harga_cus', 'customs.id', 'jumlah_pesanan_cus', "name", "kategori", "material", "ukuran", "nohp", "alamat", "lokasi", "status_cus", "ongkir_cus", "custom_id", 'customs.created_at', "alat_angkut_cus", "ket_cus"]);

            $produk = CustomDetail::join('categories', 'detail_customs.kategori', 'categories.id')->join('material', 'detail_customs.material', 'material.id')->join('customs', 'custom_id', '=', 'customs.id')->get();


        return view('admin.custom', ['custom' => $custom], compact('custom', 'produk'));
    }

    public function bayar()
    {
        $custom2 = HistoryCustom::join('users', 'history_custom.user_id', 'users.id')->join('categories', 'history_custom.id_kategori', 'categories.id')->join('material', 'history_custom.id_material', 'material.id')
        ->get(['history_custom.total_harga_cus', 'history_custom.id','jumlah_pesanan_cus', "name", "nohp", "alamat", "lokasi", "status_cus", "tanggal_transaksi_cus", "ongkir_cus", "ukuran_cus","history_custom.updated_at" , "alat_angkut_cus", "ket_cus"]);

        $produk = HistoryCustom::join('categories', 'history_custom.id_kategori', 'categories.id')->join('material', 'history_custom.id_material', 'material.id')->get();

        return view('admin.custom-bayar', compact('custom2', 'produk'));
    }

    public function edit($id, CustomP $custom)
    {

        $as = CustomP::find($id);

        return view('admin.custom-edit', compact('as'));
    }

    public function editbayar($id)
    {

        $custom2 = HistoryCustom::join('users', 'history_custom.user_id', 'users.id')->join('categories', 'history_custom.id_kategori', 'categories.id')->join('material', 'history_custom.id_material', 'material.id')->where('history_custom.id', $id)
        ->get(['history_custom.id', 'history_custom.total_harga_cus', 'jumlah_pesanan_cus', "name", "nohp", "alamat", "lokasi", "status_cus", "nama_kategori", "ongkir_cus","alat_angkut_cus", "ket_cus", "tanggal_transaksi_cus", "history_custom.updated_at"]);

        return view('admin.custom-editbayar', compact('custom2'));
    }

    public function update($id, Request $request)
    {
        $custom = CustomP::find($id);
        $custom->alat_angkut_cus = $request->alat_angkut_cus;
        $custom->ket_cus = $request->ket_cus;
        $custom->ongkir_cus = $request->ongkir_cus;
        $custom->status_cus = $request->status_cus;
        $custom->total_harga_cus = $request->total_harga_cus;

        if ($custom->total_harga_cus != null && $custom->status_cus == '0') {
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
            // dd($grandTotal);

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

    public function updatebayar($id, Request $request)
    {
        $custom = HistoryCustom::find($id);
        $custom->status_cus = $request->status_cus;
        $custom->total_harga_cus = $request->total_harga_cus;
        $custom->save();
        return redirect('/customm/bayar')->with('status', 'Data custom Berhasil Diubah!');
    }


    public function delete($id)
    {
        $custom = CustomP::find($id);
        $custom->delete();
        return redirect('/custom')->with('status', 'Data custom Berhasil Dihapus!');
    }

    public function trash()
    {
        // mengambil data custom yang sudah dihapus
        $custom = CustomP::onlyTrashed()->get();
        return view('admin.custom-trash', ['custom' => $custom]);
    }

    // restore data custom yang dihapus
    public function kembalikan($id)
    {
        $custom = CustomP::onlyTrashed()->where('id', $id);
        $custom->restore();
        return redirect('/custom')->with('status', 'Data custom Berhasil Dikembalikan!');
    }

    // restore semua data custom yang sudah dihapus
    public function kembalikan_semua()
    {

        $custom = CustomP::onlyTrashed();
        $custom->restore();

        return redirect('/custom')->with('status', 'Data custom Berhasil Dikembalikan!');
    }

    // hapus permanen
    public function hapus_permanen($id)
    {
        // hapus permanen data custom
        $custom = CustomP::onlyTrashed()->where('id', $id);
        $custom->forceDelete();

        return redirect('/custom/trash')->with('status', 'Data custom Berhasil Dihapus!');
    }

    // hapus permanen semua custom yang sudah dihapus
    public function hapus_permanen_semua()
    {
        // hapus permanen semua data custom yang sudah dihapus
        $custom = CustomP::onlyTrashed();
        $custom->forceDelete();

        return redirect('/custom/trash')->with('status', 'Data custom Berhasil Dihapus!');
    }


    public function cari(Request $request)
    {
        $custom = CustomP::sortable()->paginate(10);
        $skipped = ($custom->currentPage() * $custom->perPage()) - $custom->perPage();
        // menangkap data pencarian
        $cari = $request->get('cari');
        $custom = CustomP::all();

        if ($cari) {
            $custom = CustomP::where("nama_custom", "like", "%$cari%")->sortable()->paginate(5);
        }



        return view('admin.custom', compact('custom', 'skipped'));
    }


    public function getSub()
    {
        $custom2 = DB::table('custom')
            ->where("jabatan", "koordinator")
            ->orWhere("jabatan", "opd dinkes")
            ->orWhere("jabatan", "opd dp5a")
            ->orWhere("jabatan", "opd dkrth")
            ->orWhere("jabatan", "kecamatan")
            ->orWhere("jabatan", "kelurahan")
            ->pluck("nama_custom", "id");

        return json_encode($custom2);
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
