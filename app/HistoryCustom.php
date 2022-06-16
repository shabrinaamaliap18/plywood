<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryCustom extends Model
{
    protected $fillable = [
        'status_cus',
    ];

    protected $table = 'history_custom';

    public function category() {
        return $this->belongsTo('App\Categories','id_kategori');
    }
    public function material() {
        return $this->belongsTo('App\Models\Material','id_material');
    }
    public function user() {
        return $this->belongsTo('App\User');
    }
}
