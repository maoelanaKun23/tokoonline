<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LatihanController extends Controller
{
    public function getTabel()
    {
        $dataMahasiswa = [
            ['nim' => 'NIM 1', 'nama' => 'Nama Lengkap 1', 'kelas' => 'Kelas 1'],
            ['nim' => 'NIM 2', 'nama' => 'Nama Lengkap 2', 'kelas' => 'Kelas 2'],
        ];

        return view('latihan.tabel', compact('dataMahasiswa'));
    }

    public function getForm()
    {
        return view('latihan.form');
    }
}
