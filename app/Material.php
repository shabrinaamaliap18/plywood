<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;


class Material extends Model implements AuthenticatableContract 
{
    // use HasFactory;
    use Authenticatable;
  
    protected $fillable = ['nama_material', 'stok_material', 'foto_material'];
    protected $table = 'material';
}


