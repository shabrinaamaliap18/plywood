<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MaterialController extends Controller
{

    public function index()
    {

        $material = Material::all();
        // dd($material);


        return view('admin.material', ['material' => $material]);
    }

    public function tambah()
    {
        $material = Material::all();
        
        return view('admin.material-tambah', compact('material'));
    }


    public function store(Request $request, material $material)
    {

        $foto_material = $request->foto_material->getClientOriginalName();
        $request->foto_material->move(public_path('image'), $foto_material);

        $lastid = Material::create(([
            'nama_material' => $request->nama_material,
            'harga_material' => $request->harga_material,
            'stok_material' => $request->stok_material,
            'ukuran_material' => $request->ukuran_material,
            'foto_material' => $request->foto_material,

        ]))->id;
        
        return redirect('/material')->with('status', 'Data Material Berhasil Ditambahkan!');
    }

    public function edit($id, material $material)

    {
        $kategori = DB::table('categories')->pluck("nama_kategori", "id");
        $material = Material::find($id);


        return view('admin.material-edit', compact('material', 'kategori'));
    }

    public function update(Request $request, material $material)
    {
       
        $material_2 = $request->file('foto_material');
        if (file_exists($material_2)) {
            $material_2->move(public_path('image'), $material_2->getClientOriginalName());
            $material->foto_material = $material_2->getClientOriginalName();
        }

        $material->nama_material = $request->nama_material;
        $material->harga_material = $request->harga_material;
        $material->stok_material = $request->stok_material;

        // dd($request);
        $material->save();
        return redirect('/material')->with('status', 'Data material Berhasil Diubah!');
    }

    public function delete($id)
    {
        $material = material::find($id);
        $material->delete();
        return redirect('/material')->with('status', 'Data material Berhasil Dihapus!');
    }

    public function trash()
    {
        // mengambil data material yang sudah dihapus
        $material = material::onlyTrashed()->get();
        return view('admin.material-trash', ['material' => $material]);
    }

    // restore data material yang dihapus
    public function kembalikan($id)
    {
        $material = material::onlyTrashed()->where('id', $id);
        $material->restore();
        return redirect('/material')->with('status', 'Data material Berhasil Dikembalikan!');
    }

    // restore semua data material yang sudah dihapus
    public function kembalikan_semua()
    {

        $material = material::onlyTrashed();
        $material->restore();

        return redirect('/material')->with('status', 'Data material Berhasil Dikembalikan!');
    }

    // hapus permanen
    public function hapus_permanen($id)
    {
        // hapus permanen data material
        $material = material::onlyTrashed()->where('id', $id);
        $material->forceDelete();

        return redirect('/material/trash')->with('status', 'Data material Berhasil Dihapus!');
    }

    // hapus permanen semua material yang sudah dihapus
    public function hapus_permanen_semua()
    {
        // hapus permanen semua data material yang sudah dihapus
        $material = material::onlyTrashed();
        $material->forceDelete();

        return redirect('/material/trash')->with('status', 'Data material Berhasil Dihapus!');
    }


    public function cari(Request $request)
    {
        $material = material::sortable()->paginate(10);
        $skipped = ($material->currentPage() * $material->perPage()) - $material->perPage();
        // menangkap data pencarian
        $cari = $request->get('cari');
        $material = material::all();

        if ($cari) {
            $material = material::where("nama_material", "like", "%$cari%")->sortable()->paginate(5);
        }



        return view('admin.material', compact('material', 'skipped'));
    }


    public function getSub()
    {
        $material2 = DB::table('material')
            ->where("jabatan", "koordinator")
            ->orWhere("jabatan", "opd dinkes")
            ->orWhere("jabatan", "opd dp5a")
            ->orWhere("jabatan", "opd dkrth")
            ->orWhere("jabatan", "kecamatan")
            ->orWhere("jabatan", "kelurahan")
            ->pluck("nama_material", "id");

            return json_encode($material2);
    }

    public function getKategori()
    {
        $kategori = DB::table('categories')->pluck("nama_kategori", "id");

        return view('admin.material-tambah', compact('kategori'));
    }


    public function getKelurahan($id)
    {
        $kelurahan = DB::table('m_kelurahan')->where("no_kecamatan", $id)
            ->pluck("nama_kelurahan", "id");

        // dd($kelurahan);
        return json_encode($kelurahan);
    }
}

