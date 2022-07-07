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

    
}

