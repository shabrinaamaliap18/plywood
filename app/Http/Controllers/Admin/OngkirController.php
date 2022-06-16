<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Ongkir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OngkirController extends Controller
{

    public function index()
    {

        $Ongkir = Ongkir::all();


        return view('admin.lokasi', ['Ongkir' => $Ongkir]);
    }

    public function tambah()
    {
        $Ongkir = Ongkir::all();


        return view('admin.lokasi-tambah', compact('Ongkir'));
    }


    public function store(Request $request, Ongkir $Ongkir)
    {

        $lastid = Ongkir::create(([
            'nama_kota' => $request->nama_kota,
            'harga_ongkir' => $request->harga_ongkir,

        ]))->id;
        
        return redirect('/ongkir')->with('status', 'Data Ongkir Berhasil Ditambahkan!');
    }

    public function edit($id, Ongkir $Ongkir)

    {
        $Ongkir = Ongkir::find($id);


        return view('admin.lokasi-edit', compact('Ongkir'));
    }

    public function update(Request $request, Ongkir $Ongkir)
    {
        

        $Ongkir->nama_kota = $request->nama_kota;
        $Ongkir->harga_ongkir = $request->harga_ongkir;
        
        // dd($request);
        $Ongkir->save();
        return redirect('/ongkir')->with('status', 'Data Ongkir Berhasil Diubah!');
    }

    public function delete($id)
    {
        $Ongkir = Ongkir::find($id);
        $Ongkir->delete();
        return redirect('/ongkir')->with('status', 'Data Ongkir Berhasil Dihapus!');
    }

    public function trash()
    {
        // mengambil data Ongkir yang sudah dihapus
        $Ongkir = Ongkir::onlyTrashed()->get();
        return view('admin.lokasi-trash', ['Ongkir' => $Ongkir]);
    }

    // restore data Ongkir yang dihapus
    public function kembalikan($id)
    {
        $Ongkir = Ongkir::onlyTrashed()->where('id', $id);
        $Ongkir->restore();
        return redirect('/ongkir')->with('status', 'Data Ongkir Berhasil Dikembalikan!');
    }

    // restore semua data Ongkir yang sudah dihapus
    public function kembalikan_semua()
    {

        $Ongkir = Ongkir::onlyTrashed();
        $Ongkir->restore();

        return redirect('/ongkir')->with('status', 'Data Ongkir Berhasil Dikembalikan!');
    }

    // hapus permanen
    public function hapus_permanen($id)
    {
        // hapus permanen data Ongkir
        $Ongkir = Ongkir::onlyTrashed()->where('id', $id);
        $Ongkir->forceDelete();

        return redirect('/ongkir/trash')->with('status', 'Data Ongkir Berhasil Dihapus!');
    }

    // hapus permanen semua Ongkir yang sudah dihapus
    public function hapus_permanen_semua()
    {
        // hapus permanen semua data Ongkir yang sudah dihapus
        $Ongkir = Ongkir::onlyTrashed();
        $Ongkir->forceDelete();

        return redirect('/ongkir/trash')->with('status', 'Data Ongkir Berhasil Dihapus!');
    }


    public function cari(Request $request)
    {
        $Ongkir = Ongkir::sortable()->paginate(10);
        $skipped = ($Ongkir->currentPage() * $Ongkir->perPage()) - $Ongkir->perPage();
        // menangkap data pencarian
        $cari = $request->get('cari');
        $Ongkir = Ongkir::all();

        if ($cari) {
            $Ongkir = Ongkir::where("nama_kota", "like", "%$cari%")->sortable()->paginate(5);
        }



        return view('Ongkir.Ongkir', compact('Ongkir', 'skipped'));
    }


    public function getSub()
    {
        $Ongkir2 = DB::table('Ongkir')
            ->where("jabatan", "koordinator")
            ->orWhere("jabatan", "opd dinkes")
            ->orWhere("jabatan", "opd dp5a")
            ->orWhere("jabatan", "opd dkrth")
            ->orWhere("jabatan", "kecamatan")
            ->orWhere("jabatan", "kelurahan")
            ->pluck("nama_kota", "id");

            return json_encode($Ongkir2);
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

