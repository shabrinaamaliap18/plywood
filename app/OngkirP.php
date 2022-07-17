<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OngkirP extends Model
{
    protected $fillable = [
        'nama_kota',
        'harga_ongkir',
    ];

    protected $table = 'ongkir_p';

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id', 'id');
    }
}
