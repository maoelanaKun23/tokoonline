<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistribusiQurban extends Model
{
    use HasFactory;

    protected $table = 'distribusi_qurban'; // nama tabel

    // Kolom yang boleh diisi mass assignment
    protected $fillable = [
        'warga_id',
        'kurban_id',
        'jumlah_daging',
    ];

    // Relasi ke Warga (yang menerima distribusi)
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id');
    }

    // Relasi ke Kurban (jenis kurban yang didistribusikan)
    public function kurban()
    {
        return $this->belongsTo(Kurban::class, 'kurban_id');
    }
}
