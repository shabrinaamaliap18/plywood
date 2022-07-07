<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\PesananDetail;
use App\Pesanan;

class EditSingletonCart extends Component
{
    public $no;
    public $detailPesananId;
    public $image;
    public $name;
    public $amount;
    public $price;
    public $total_price;


    public function mount($no,$id,$image,$name,$amount,$price,$total_price) {
        $detail = PesananDetail::find($id);
        if($detail) {
            $this->no = $no;
            $this->detailPesananId = $detail->id;
            $this->amount = $detail->jumlah_pesanan;
            $this->image = $image;
            $this->name = $name;
            $this->price = $price;
            $this->total_price = $detail->total_harga;
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
        $pesanan_detail->total_harga = ($this->amount*$pesanan_detail->product->jml_ukuran*$pesanan_detail->product->harga)/1000000000;
        $pesanan_detail->update();

        $pesanan = $pesanan_detail->pesanan;
        $updater = $pesanan->pesanan_details()->selectRaw('sum(pesanan_details.total_harga) as total')->groupBy('pesanan_id')->first();
        $pesanan->total_harga = $updater->total + $pesanan->ongkir;
        $pesanan->update();

        // UPDATE ATTRIBUTE STATE
        $this->total_price = $pesanan_detail->total_harga;

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
