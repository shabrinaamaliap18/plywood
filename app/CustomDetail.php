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

}
