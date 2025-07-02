<?php

namespace App\Imports;

use App\Models\Warga;
// use Maatwebsite\Excel\Concerns\ToModel;
// use Maatwebsite\Excel\Concerns\WithHeadingRow;


// class WargaImport implements ToModel, WithHeadingRow
// {
//     public function model(array $row)
//     {
//         return new Warga([
//             'nama'      => $row['nama'],
//             'nik'       => $row['nik'],
//             'alamat'    => $row['alamat'],
//             'rt'        => $row['rt'],
//             'rw'        => $row['rw'],
//             'gaji'      => $row['gaji'],
//             'lokasi_id' => $row['lokasi_id'],
//             'prioritas' => $row['prioritas'],
//         ]);
//     }
// }

use App\Models\Lokasi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class WargaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $lokasi = Lokasi::where('nama_desa', $row['desa'])->first();

        return new Warga([
            'nama'      => $row['nama'],
            'nik'       => $row['nik'],
            'alamat'    => $row['alamat'],
            'rt'        => $row['rt'],
            'rw'        => $row['rw'],
            'gaji'      => $row['gaji'],
            'lokasi_id' => $lokasi ? $lokasi->id : null, 
            'prioritas' => $row['prioritas'],
        ]);
    }
}


