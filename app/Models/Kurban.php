<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurban extends Model
{
    use HasFactory;

    protected $table = 'kurban';

    protected $fillable = [
        'jenis',
        'jumlah_daging',
        'lokasi_id',
        'panitia_id',
        'tahun',
    ];

    // Relasi ke lokasi
    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'lokasi_id');
    }

    // Relasi ke panitia (user)
    public function panitia()
    {
        return $this->belongsTo(User::class, 'panitia_id');
    }

    // Relasi ke distribusi
    public function distribusis()
    {
        return $this->hasMany(DistribusiQurban::class, 'kurban_id');
    }
}
