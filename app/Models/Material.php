<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;


class Material extends Model implements AuthenticatableContract 
{
    // use HasFactory;
    use Authenticatable;
  
    protected $fillable = ['nama_material', 'harga_material', 'stok_material', 'foto material'];
    protected $table = 'material';
}