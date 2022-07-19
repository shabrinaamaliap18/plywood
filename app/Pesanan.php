<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $fillable = [
        'kode_pemesanan',
        'tanggal_transaksi',
        'tanggal_terima',
        'status',
        'total_harga',
        'alat_angkut',
        'ket',
        'user_id',
        'ongkir',
        'kode_midtrans',
        'uniqode',
    ];

    public function pesanan_details()
    {
        return $this->hasMany(PesananDetail::class, 'pesanan_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
