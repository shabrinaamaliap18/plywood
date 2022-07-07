<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['nama', 'kategori','material', 'ukuran', 'jml_ukuran', 'harga','jml_ukuran','gambar_produk'];
    protected $table = 'products';


    public function categories()
    {
        return $this->belongsTo(Categories::class, 'id_kategori', 'id');
    }

    public function pesanan_details()
    {
        return $this->hasMany(PesananDetail::class, 'product_id', 'id');
    }

}
