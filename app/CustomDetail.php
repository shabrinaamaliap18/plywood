<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomDetail extends Model
{
    protected $fillable = [
        'kategori',
        'material',
        'ukuran',
        'jumlah_pesanan_cus',
        'total_harga_cus',
        'custom_id',
        'kode_midtrans',
        'uniqode',
    ];

    protected $table = 'detail_customs';

    public function custom()
    {
        return $this->belongsTo(Custom::class, 'custom_id', 'id');
    }
    public function kategori() {
        return $this->belongsTo(Categories::class,'kategori');
    }
    public function material() {
        return $this->belongsTo('App\Models\Material','material');
    }
    public function product() {
        $kategori = $this->kategori()->first();
        $material = $this->material()->first();
        if($kategori && $material) {
            return Product::whereKategori($kategori->nama_kategori)->whereMaterial($material->nama_material)->first();
        }
        return null;
    }

}
