<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesananDetail extends Model
{
    protected $fillable = [
        'jumlah_pesanan',
        'harga',
        'product_id',
        'pesanan_id',
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    // public function kategory() {
    //     return $this->belongsTo(Categories::class,'kategori','id');
    // }
    // public function materyal() {
    //     return $this->belongsTo('App\Models\Material','material','id');
    // }


}
