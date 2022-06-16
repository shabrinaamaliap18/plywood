<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryCustom extends Model
{
    protected $fillable = [
        'status_cus',
    ];

    protected $table = 'history_custom';
}
