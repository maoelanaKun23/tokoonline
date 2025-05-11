<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::latest()->get();
        return view('v_anggota.index', compact('anggota'))->with('judul', 'Data Anggota');
    }

    public function create()
    {
        return view('v_anggota.create')->with('judul', 'Tambah Anggota');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|max:255',
            'hp' => 'required|min:10|max:13',
        ]);

        Anggota::create($validated);
        return redirect()->route('v_anggota.index');
    }

    public function destroy($id)
    {
        Anggota::destroy($id);
        return redirect()->route('v_anggota.index');
    }

    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('v_anggota.edit', compact('anggota'))->with('judul', 'Edit Anggota');
    }

    public function update(Request $request, $id)
    {
        $anggota = Anggota::findOrFail($id);
        $validated = $request->validate([
            'nama' => 'required|max:255',
            'hp' => 'required|min:10|max:13',
        ]);
        $anggota->update($validated);
        return redirect()->route('v_anggota.index');
    }
}
