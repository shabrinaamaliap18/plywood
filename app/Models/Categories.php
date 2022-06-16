<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;


class Categories extends Model implements AuthenticatableContract 
{
    // use HasFactory;
    use Authenticatable;
  
    protected $fillable = ['nama_kategori', 'keterangan_kategori', 'stok', 'foto_kategori'];
    protected $table = 'categories';
}