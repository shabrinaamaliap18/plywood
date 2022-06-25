<?php

namespace App;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

use App\Notification as N;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'lokasi', 'alamat', 'nohp', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pesanans()
    {
        return $this->hasMany(Pesanan::class, 'user_id', 'id');
    }
    public function customs() {
        return $this->hasMany(CustomP::class,'user_id','id');
    }
    public function checkoutableCount() {
        return $this->customs()->where('total_harga_cus', '>', '0')->whereStatus_cus('0')->count();
    }


    /**
     * NOTIFICATIONS
     */
    public function notifications() {
        return $this->hasMany(N::class, 'user_id');
    }
    public function unreadNotifications() {
        return $this->notifications()->whereRead_at(null)->latest();
    }
    public function markAsRead() {
        return $this->notifications()->whereNull('read_at')->update([
            'read_at' => now()
        ]);
    }
    public function createNotification($text = null,$link = null) {
        if(!$text) {
            dd('Unable To Create Notification.');
            return false;
        }

        return $this->notifications()->create([
            'text' => $text,
            'link' => $link
        ]);
    }
}
