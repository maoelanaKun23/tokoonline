<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Lokasi; // tambah ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Imports\WargaImport;
use Maatwebsite\Excel\Facades\Excel;

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
        $lokasi = Lokasi::find($request->lokasi_id);
        $prioritas = $request->gaji < $lokasi->umr ? true : false;
        Warga::create(array_merge($request->all(), ['prioritas' => $prioritas]));
        return redirect()->route('backend.warga.index')->with('success', 'Data warga berhasil ditambahkan.');

        // Warga::create($request->all());

        // return redirect()->route('backend.warga.index')->with('success', 'Data warga berhasil ditambahkan.');
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
            'gaji' => 'required|numeric|min:0',
        ]);

        $lokasi = Lokasi::find($request->lokasi_id);
        $prioritas = $request->gaji < $lokasi->umr ? true : false;

        $warga->update(array_merge($request->all(), ['prioritas' => $prioritas]));

        return redirect()->route('backend.warga.index')->with('success', 'Data warga berhasil diperbarui.');
    }


    public function destroy(Warga $warga)
    {
        $warga->delete();

        return redirect()->route('backend.warga.index')->with('success', 'Data warga berhasil dihapus.');
    }

    public function showImportForm()
    {
        return view('backend.warga.import');
    }

    public function show($id)
    {
        $warga = Warga::findOrFail($id);
        return view('backend.warga.show', compact('warga'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xls,xlsx',
        ]);

        try {
            Excel::import(new WargaImport, $request->file('excel_file'));
            return redirect()->route('backend.warga.index')->with('success', 'Data warga berhasil diimport.');
        } catch (\Exception $e) {
            return redirect()->route('backend.warga.index')->with('error', 'Terjadi kesalahan saat import: ' . $e->getMessage());
        }
    }
}
