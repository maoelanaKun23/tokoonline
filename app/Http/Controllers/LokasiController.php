<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LokasiController extends Controller
{
    public function index()
    {
        // $lokasis = Lokasi::all();
        // return view('backend.lokasi.index', compact('lokasis'));
        $lokasis = Lokasi::where('admin_id', Auth::id())->get();

        return view('backend.lokasi.index', compact('lokasis'));
    }

    public function create()
    {
        return view('backend.lokasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_desa' => 'required|string|max:255',
            'admin_id' => 'nullable|exists:user,id', // kalau ada relasi admin
            'umr' => 'required|numeric|min:0',
        ]);

        // Lokasi::create($request->all());
        Lokasi::create([
            'nama_desa' => $request->nama_desa,
            'umr' => $request->umr,
            'admin_id' => Auth::id(),
        ]);

        return redirect()->route('backend.lokasi.index')->with('success', 'Data lokasi berhasil ditambahkan.');
    }

    public function edit(Lokasi $lokasi)
    {
        return view('backend.lokasi.edit', compact('lokasi'));
    }

    public function update(Request $request, Lokasi $lokasi)
    {
        $request->validate([
            'nama_desa' => 'required|string|max:255',
            'admin_id' => 'nullable|exists:user,id',
            'umr' => 'required|numeric|min:0',
        ]);

        $lokasi->update($request->all());

        return redirect()->route('backend.lokasi.index')->with('success', 'Data lokasi berhasil diperbarui.');
    }

    public function destroy(Lokasi $lokasi)
    {
        $lokasi->delete();

        return redirect()->route('backend.lokasi.index')->with('success', 'Data lokasi berhasil dihapus.');
    }
}
