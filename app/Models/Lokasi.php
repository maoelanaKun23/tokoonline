<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;

    protected $table = 'lokasi';

    protected $fillable = [
        'nama_lokasi',
        'alamat',
        'rt',
        'rw',
        'desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'admin_id',
    ];

    /**
     * Relasi ke admin yang memiliki lokasi ini.
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    /**
     * Relasi ke semua user/panitia yang bertugas di lokasi ini.
     */
    public function panitias()
    {
        return $this->hasMany(User::class, 'lokasi_id');
    }
}
