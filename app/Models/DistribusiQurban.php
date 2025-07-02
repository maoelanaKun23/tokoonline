<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistribusiQurban extends Model
{
    use HasFactory;

    protected $table = 'distribusi_qurban'; // nama tabel

    protected $fillable = [
        'kurban_id',
        'panitia_id',
        'jumlah_daging',
        'status',
        'keterangan',
    ];

    // Relasi ke kurban
    public function kurban()
    {
        return $this->belongsTo(Kurban::class, 'kurban_id');
    }

    // Relasi ke panitia (user yang menerima distribusi)
    public function panitia()
    {
        return $this->belongsTo(User::class, 'panitia_id');
    }

    // Relasi ke distribusi_warga (lanjutan distribusi dari panitia ke warga)
    public function wargaDistribusi()
    {
        return $this->hasMany(DistribusiWarga::class, 'distribusi_id');
    }
}
