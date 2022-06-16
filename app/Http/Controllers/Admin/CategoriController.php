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
            'stok' => $request->stok,
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
        $categories->stok = $request->stok;
        $categories->foto_kategori = $request->foto_kategori;
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

    public function trash()
    {
        // mengambil data categories yang sudah dihapus
        $categories = categories::onlyTrashed()->get();
        return view('admin.categories-trash', ['categories' => $categories]);
    }

    // restore data categories yang dihapus
    public function kembalikan($id)
    {
        $categories = categories::onlyTrashed()->where('id', $id);
        $categories->restore();
        return redirect('/categories')->with('status', 'Data categories Berhasil Dikembalikan!');
    }

    // restore semua data categories yang sudah dihapus
    public function kembalikan_semua()
    {

        $categories = categories::onlyTrashed();
        $categories->restore();

        return redirect('/categories')->with('status', 'Data categories Berhasil Dikembalikan!');
    }

    // hapus permanen
    public function hapus_permanen($id)
    {
        // hapus permanen data categories
        $categories = categories::onlyTrashed()->where('id', $id);
        $categories->forceDelete();

        return redirect('/categories/trash')->with('status', 'Data categories Berhasil Dihapus!');
    }

    // hapus permanen semua categories yang sudah dihapus
    public function hapus_permanen_semua()
    {
        // hapus permanen semua data categories yang sudah dihapus
        $categories = categories::onlyTrashed();
        $categories->forceDelete();

        return redirect('/categories/trash')->with('status', 'Data categories Berhasil Dihapus!');
    }


    public function cari(Request $request)
    {
        $categories = categories::sortable()->paginate(10);
        $skipped = ($categories->currentPage() * $categories->perPage()) - $categories->perPage();
        // menangkap data pencarian
        $cari = $request->get('cari');
        $categories = categories::all();

        if ($cari) {
            $categories = categories::where("nama_categories", "like", "%$cari%")->sortable()->paginate(5);
        }



        return view('admin.categories', compact('categories', 'skipped'));
    }


    
}

