<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistribusiWarga extends Model
{
    use HasFactory;

    protected $table = 'distribusi_warga';

    protected $fillable = [
        'distribusi_id',
        'warga_id',
        'rw',
        'jumlah_daging',
        'status',
        'keterangan',
    ];

    public function distribusi()
    {
        return $this->belongsTo(DistribusiQurban::class, 'distribusi_id');
    }

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id');
    }

    public function wargaRW()
    {
        return Warga::where('rw', $this->rw)->get();
    }
}
