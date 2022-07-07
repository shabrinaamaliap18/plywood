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
            'kategori' => $request->kategori,
            'material' => $request->material,
            'ukuran' => $request->ukuran,
            'jml_ukuran' => $request->jml_ukuran,
            'harga' => $request->harga,
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
        $produk->kategori = $request->kategori;
        $produk->material = $request->material;
        $produk->ukuran = $request->ukuran;
        $produk->jml_ukuran = $request->jml_ukuran;
        $produk->harga = $request->harga;
        $produk->save();
        return redirect('/produk')->with('status', 'Data produk Berhasil Diubah!');
    }

    public function delete($id)
    {
        $produk = Product::find($id);
        $produk->delete();
        return redirect('/produk')->with('status', 'Data produk Berhasil Dihapus!');
    }

    


}

