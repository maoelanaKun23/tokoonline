<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "user"; 

    protected $fillable = [ 
        'name', 
        'email', 
        'role', 
        'status', 
        'password', 
        'phone_number', 
        'photo',
        'admin_id',
        'lokasi_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', 
    ];

    /**
     * Jika user ini adalah panitia, maka dia punya admin.
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    /**
     * Jika user ini adalah admin, maka dia punya banyak panitia.
     */
    public function panitia()
    {
        return $this->hasMany(User::class, 'admin_id');
    }

    /**
     * Relasi ke lokasi yang dipegang panitia/user.
     */
    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'lokasi_id');
    }

    /**
     * Relasi ke lokasi yang dikelola admin.
     */
    public function lokasiYangDikelola()
    {
        return $this->hasOne(Lokasi::class, 'admin_id');
    }
}
