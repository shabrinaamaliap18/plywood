<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = [
        'status',
    ];

    protected $table = 'histories';

    public function product() {
        return $this->belongsTo('App\Product');
    }
    public function user() {
        return $this->belongsTo('App\User');
    }
}
