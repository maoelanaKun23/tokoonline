<?php

namespace App\Http\Controllers;

use App\Models\DistribusiQurban;
use App\Models\Warga;
use App\Models\Kurban;
use Illuminate\Http\Request;

class DistribusiQurbanController extends Controller
{
    // Menampilkan daftar distribusi kurban
    public function index()
    {
        // Ambil semua data distribusi beserta relasi warga dan kurban
        $distribusis = DistribusiQurban::with(['warga', 'kurban'])->get();

        return view('backend.distribusi_qurban.index', compact('distribusis'));
    }

    // Tampilkan form tambah distribusi kurban
    public function create()
    {
        $wargas = Warga::all(); // ambil data warga untuk dropdown
        $kurbans = Kurban::all(); // ambil data kurban untuk dropdown

        return view('backend.distribusi_qurban.create', compact('wargas', 'kurbans'));
    }

    // Simpan data distribusi kurban baru
    public function store(Request $request)
    {
        $request->validate([
            'warga_id' => 'required|exists:warga,id',
            'kurban_id' => 'required|exists:kurban,id',
            'jumlah_daging' => 'required|numeric|min:0',
        ]);

        DistribusiQurban::create($request->all());

        return redirect()->route('backend.distribusi_qurban.index')->with('success', 'Data distribusi berhasil ditambahkan.');
    }

    // Tampilkan form edit data distribusi kurban
    public function edit(DistribusiQurban $distribusi_qurban)
    {
        $wargas = Warga::all();
        $kurbans = Kurban::all();

        return view('backend.distribusi_qurban.edit', compact('distribusi_qurban', 'wargas', 'kurbans'));
    }

    // Update data distribusi kurban
    public function update(Request $request, DistribusiQurban $distribusi_qurban)
    {
        $request->validate([
            'warga_id' => 'required|exists:warga,id',
            'kurban_id' => 'required|exists:kurban,id',
            'jumlah_daging' => 'required|numeric|min:0',
        ]);

        $distribusi_qurban->update($request->all());

        return redirect()->route('backend.distribusi_qurban.index')->with('success', 'Data distribusi berhasil diperbarui.');
    }

    // Hapus data distribusi kurban
    public function destroy(DistribusiQurban $distribusi_qurban)
    {
        $distribusi_qurban->delete();

        return redirect()->route('backend.distribusi_qurban.index')->with('success', 'Data distribusi berhasil dihapus.');
    }
}
