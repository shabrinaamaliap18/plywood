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
        return $this->belongsTo(CustomP::class, 'custom_id', 'id');
    }
    public function kategori() {
        return $this->belongsTo(Categories::class,'kategori','id');
    }
    public function material() {
        return $this->belongsTo('App\Models\Material','material','id');
    }

    public function kategory() {
        return $this->belongsTo(Categories::class,'kategori','id');
    }
    public function materyal() {
        return $this->belongsTo('App\Models\Material','material','id');
    }

    public function product() {
        $kategori = $this->kategory()->first();
        $material = $this->materyal()->first();
        if($kategori && $material) {
            return Product::where(function($q) use($kategori) {
                $q->whereKategori($kategori->nama_kategori)
                ->orWhere('kategori',\strtolower($kategori->nama_kategori))
                ->orWhere('kategori',\ucfirst($kategori->nama_kategori));
            })->where(function($q) use($material) {
                $q->whereMaterial($material->nama_material)
                ->orWhere('material',\ucfirst($material->nama_material))
                ->orWhere('material',\strtolower($material->nama_material));
            })->first();
        }
        return null;
    }

}
