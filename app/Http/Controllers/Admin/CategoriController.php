<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoriController extends Controller
{

    public function index()
    {

        $categories = Categories::all();


        return view('admin.categories', ['categories' => $categories]);
    }

    public function tambah()
    {
        $categories = Categories::all();


        return view('admin.categories-tambah', compact('categories'));
    }


    public function store(Request $request, categories $categories)
    {

        $foto_kategori = $request->foto_kategori->getClientOriginalName();
        $request->foto_kategori->move(public_path('image'), $foto_kategori);

        $lastid = Categories::create(([
            'nama_kategori' => $request->nama_kategori,
            'keterangan_kategori' => $request->keterangan_kategori,
            'foto_kategori' => $request->foto_kategori,

        ]))->id;
        
        return redirect('/categories')->with('status', 'Data Kategori Berhasil Ditambahkan!');
    }

    public function edit($id, categories $categories)

    {
        $categories = categories::find($id);


        return view('admin.categories-edit', compact('categories'));
    }

    public function update(Request $request, categories $categories)
    {
        

        $categories_2 = $request->file('foto_kategori');
        if (file_exists($categories_2)) {
            $categories_2->move(public_path('image'), $categories_2->getClientOriginalName());
            $categories->foto_kategori = $categories_2->getClientOriginalName();
        }

        $categories->nama_kategori = $request->nama_kategori;
        $categories->keterangan_kategori = $request->keterangan_kategori;
        // dd($request);
        $categories->save();
        
        return redirect('/categories')->with('status', 'Data Kategori Berhasil Diubah!');
    }

    public function delete($id)
    {
        $categories = categories::find($id);
        $categories->delete();
        return redirect('/categories')->with('status', 'Data categories Berhasil Dihapus!');
    }

   

    
}

