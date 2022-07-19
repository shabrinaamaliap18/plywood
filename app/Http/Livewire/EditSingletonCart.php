<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\PesananDetail;
use App\Pesanan;
use App\Ongkir;

class EditSingletonCart extends Component
{
    public $no;
    public $detailPesananId;
    public $image;
    public $name;
    public $amount;
    public $price;
    public $total_price;
    public $alat_angkut;

    public function mount($no,$id,$image,$name,$amount,$price,$total_price,$alat_angkut,$harga_ongkir) {
        $detail = PesananDetail::find($id);
        if($detail) {
            $this->no = $no;
            $this->detailPesananId = $detail->id;
            $this->amount = $detail->jumlah_pesanan;
            $this->image = $image;
            $this->name = $name;
            $this->price = $price;
            $this->total_price = $detail->harga;
            $this->alat_angkut = $alat_angkut;
        }
    }

    public function destroy()
    {
        $pesanan_detail = PesananDetail::find($this->detailPesananId);
        if (!empty($pesanan_detail)) {

            $pesanan = Pesanan::where('id', $pesanan_detail->pesanan_id)->first();
            $jumlah_pesanan_detail = PesananDetail::where('pesanan_id', $pesanan->id)->count();
            if ($jumlah_pesanan_detail == 1) {
                $pesanan->delete();
            } else {
                $pesanan->total_harga = $pesanan->total_harga - $pesanan_detail->total_harga;
                $pesanan->update();
            }

            $pesanan_detail->delete();
        }

        $this->emit('refreshComponent');
        $this->emitUp('updatedNotification', ['type' => 'success','msg' => 'Keranjang berhasil dihapus']);
        $this->emit('masukKeranjang');
    }

    public function updates() {
        $pesanan_detail = PesananDetail::find($this->detailPesananId);

        $pesanan_detail->jumlah_pesanan = $this->amount;

        $pesanan_detail->harga = ($this->amount*$pesanan_detail->product->jml_ukuran*$pesanan_detail->product->harga)/1000000000;
        $pesanan_detail->update();

        $pesanan = $pesanan_detail->pesanan;
        $updater = $pesanan->pesanan_details()->selectRaw('sum(pesanan_details.harga) as total')->groupBy('pesanan_id')->first();
        $pesanan->total_harga = $updater->total + $pesanan->ongkir;
        $pesanan->update();

        // UPDATE ATTRIBUTE STATE
        $this->total_price = $pesanan_detail->harga;

        //Menghitung jml kubik
        $totalUkuran = 0;
        foreach ($pesanan->pesanan_details as $row) {
            $totalUkuran += $row->product->jml_ukuran;
        }
        $ak = $pesanan->pesanan_details()->sum('jumlah_pesanan') * ($totalUkuran) / 1000000000;
        //ngecek apa jml kubik lebih dri 5
        if ($ak >= 5) {
            $alat_angkut = 'Truck Kun';
        } else {
            $alat_angkut = 'Pickup';
        }
        // dd($alat_angkut);

        //mencari harga ongkir (nama lokasi yg sama dg user == nama kota di tabel ongkir sesuai alat angkut)
        $ongkir = Ongkir::where([
            'nama_kota' => auth()->user()->lokasi,
            'alat_angkut' => $alat_angkut,
        ])->first();
        // dd($ongkir);

        if(!$ongkir) {
            $ongkir = Ongkir::create([
                'nama_kota' => auth()->user()->lokasi,
                'alat_angkut' => $alat_angkut,
            ]);
        }

        if($ongkir->harga_ongkir > 0) {
            $pesanan->alat_angkut = $ongkir->alat_angkut;
            $pesanan->ongkir = $ongkir->harga_ongkir;
            $this->alat_angkut = $ongkir->alat_angkut;
            $this->harga_ongkir = $ongkir->harga_ongkir;
            $pesanan->save();
        } else {
            $this->emitUp('updatedNotification', ['type' => 'warning', 'msg' => 'Estimasi harga ongkir anda sedang dihitung oleh admin, tunggu beberapa saat.']);
            return;
        }

        // EMIT EVENT
        $this->emit('refreshComponent');
        $this->emitUp('updatedNotification', ['type' => 'success', 'msg' => 'Keranjang Berhasil Diupdate.']);
        $this->emit('masukKeranjang');
    }

    public function render()
    {
        return view('livewire.edit-singleton-cart');
    }
}
