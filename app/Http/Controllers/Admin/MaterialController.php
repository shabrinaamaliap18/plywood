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
            'stok_material' => $request->stok_material,
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

}

