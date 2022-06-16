<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;


class Admin extends Model implements AuthenticatableContract 
{
    // use HasFactory;
    use Authenticatable;
  
    protected $fillable = ['name', 'username', 'email', 'password', 'foto_admin'];
    protected $table = 'admin';
}