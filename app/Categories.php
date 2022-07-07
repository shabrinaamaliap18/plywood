<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;


class Categories extends Model implements AuthenticatableContract 
{
    // use HasFactory;
    use Authenticatable;
  
    protected $fillable = ['nama_kategori', 'keterangan_kategori', 'gambar'];
    protected $table = 'categories';
}

function products()
    {
        return $this->hasMany(Product::class, 'id_kategori', 'id');
    }
