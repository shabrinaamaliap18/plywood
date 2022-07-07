<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ongkir extends Model
{
    protected $fillable = [
        'nama_kota',
        'harga_ongkir',
    ];

    protected $table = 'ongkir';

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id', 'id');
    }
}
