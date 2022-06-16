<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function index()
    {
        $produk = Product::all();
        return view('admin.produk', ['produk' => $produk]);
    }

    public function tambah()
    {
        $produk = Product::all();
        return view('admin.produk-tambah', compact('produk'));
    }


    public function store(Request $request, Product $produk)
    {

        $gambar_produk = $request->gambar_produk->getClientOriginalName();
        $request->gambar_produk->move(public_path('image'), $gambar_produk);

        $lastid = Product::create(([
            'nama' => $request->nama,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'is_ready' => $request->is_ready,
            'gambar_produk' => $request->gambar_produk,

        ]))->id;
        
        return redirect('/produk')->with('status', 'Data Produk Berhasil Ditambahkan!');
    }

    public function edit($id, product $produk)

    {
        $produk = Product::find($id);
        return view('admin.produk-edit', compact('produk'));
    }

    public function update(Request $request, Product $produk)
    {
       
        $produk_2 = $request->file('gambar_produk');
        if (file_exists($produk_2)) {
            $produk_2->move(public_path('image'), $produk_2->getClientOriginalName());
            $produk->gambar_produk = $produk_2->getClientOriginalName();
        }

        $produk->nama = $request->nama;
        $produk->stok = $request->stok;
        $produk->harga = $request->harga;
        $produk->is_ready = $request->is_ready;
        $produk->save();
        return redirect('/produk')->with('status', 'Data produk Berhasil Diubah!');
    }

    public function delete($id)
    {
        $produk = Product::find($id);
        $produk->delete();
        return redirect('/produk')->with('status', 'Data produk Berhasil Dihapus!');
    }

    public function getSub()
    {
        $produk2 = DB::table('produk')
            ->where("jabatan", "koordinator")
            ->orWhere("jabatan", "opd dinkes")
            ->orWhere("jabatan", "opd dp5a")
            ->orWhere("jabatan", "opd dkrth")
            ->orWhere("jabatan", "kecamatan")
            ->orWhere("jabatan", "kelurahan")
            ->pluck("nama_produk", "id");

            return json_encode($produk2);
    }

    public function getKategori()
    {
        $kategori = DB::table('categories')->pluck("nama_kategori", "id");

        return view('admin.produk-tambah', compact('kategori'));
    }



}

