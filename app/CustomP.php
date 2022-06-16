<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomP extends Model
{
    protected $fillable = [
        'kode_pemesanan_cus',
        'status_cus',
        'total_harga_cus',
        'tanggal_transaksi_cus',
        'alat_angkut_cus',
        'ket_cus',
        'user_id',
    ];

    protected $table = 'customs';


    public function custom_details()
    {
        return $this->hasMany(CustomDetail::class, 'custom_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
