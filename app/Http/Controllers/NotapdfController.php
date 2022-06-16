<?php

namespace App\Http\Controllers;

use \Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\History;

class NotapdfController extends Controller
{

    public $pdf;
    public function pdf($id)
    {

        if (Auth::user()) {
           

        $this->pdf = History::join('products', 'histories.product_id', 'products.id')->join('users', 'histories.user_id', 'users.id')->where('histories.id', $id)->where('user_id', Auth::user()->id)->get(['histories.id', "product_id", "user_id", 'status', "total_harga", "name", "nama_perusahaan", "alamat", "nohp", "lokasi", "jumlah_pesanan", "nama", "kategori", "jml_ukuran",  "histories.tanggal_transaksi", "alat_angkut", "ket", 'histories.updated_at']);
        // dd($this->order);

        $pdf = PDF::loadView('livewire.notapdf', [
            'pdf' => $this->pdf
        ]);
        //KEMUDIAN BUKA FILE PDFNYA DI BROWSER
        return $pdf->stream();
    }
}
}