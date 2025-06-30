<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Lokasi; // tambah ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WargaController extends Controller
{
    public function index()
    {
        // $warga = Warga::all();
        // return view('backend.warga.index', compact('warga'));
        {
            $warga = Warga::with('lokasi')->get();
            return view('backend.warga.index', compact('warga'));
        }
    }

    public function create()
    {
        $lokasi = Lokasi::all(); // ambil semua lokasi
        return view('backend.warga.create', compact('lokasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20|unique:warga,nik',
            'alamat' => 'required|string|max:255',
            'rt' => 'required|string|max:10',
            'rw' => 'required|string|max:10',
            'desa' => 'required|string|max:255',
            'gaji' => 'required|numeric|min:0',
            'lokasi_id' => 'required|exists:lokasi,id',
        ]);

        Warga::create($request->all());

        return redirect()->route('backend.warga.index')->with('success', 'Data warga berhasil ditambahkan.');
    }

    public function edit(Warga $warga)
    {
        $lokasi = Lokasi::all(); // ambil semua lokasi
        return view('backend.warga.edit', compact('warga', 'lokasi'));
    }

    public function update(Request $request, Warga $warga)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20|unique:warga,nik,' . $warga->id,
            'alamat' => 'required|string|max:255',
            'rt' => 'required|string|max:10',
            'rw' => 'required|string|max:10',
            'desa' => 'required|string|max:255',
            'lokasi_id' => 'required|exists:lokasi,id',
        ]);

        $warga->update($request->all());

        return redirect()->route('backend.warga.index')->with('success', 'Data warga berhasil diperbarui.');
    }

    public function destroy(Warga $warga)
    {
        $warga->delete();

        return redirect()->route('backend.warga.index')->with('success', 'Data warga berhasil dihapus.');
    }
}
