<?php

namespace App\Http\Controllers;

use \Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\HistoryCustom;

class NotaCustomController extends Controller
{

    public $order;
    public function pdf($id)
    {

        if (Auth::user()) {


            // $this->order = HistoryCustom::join('categories', 'history_custom.id_kategori', 'categories.id')->join('users', 'history_custom.user_id', 'users.id')->join('material', 'history_custom.id_material', 'material.id')->where('user_id', Auth::user()->id)->where('history_custom.id', $id)->get(['history_custom.id', 'history_custom.tanggal_transaksi_cus', 'history_custom.created_at', 'history_custom.updated_at',"nama_perusahaan", "alamat", "nohp", "lokasi","alat_angkut_cus", "ket_cus",  "user_id", 'status_cus', "total_harga_cus", "jumlah_pesanan_cus", "nama_kategori", "nama_material", "ukuran_cus"]);
            $this->order = HistoryCustom::with(['category','material','user'])->firstOrFail();


            $pdf = PDF::loadView('livewire.nota-custom', [
                'order' => $this->order
            ]);
            //KEMUDIAN BUKA FILE PDFNYA DI BROWSER
            return $pdf->stream();
        }
    }
}
