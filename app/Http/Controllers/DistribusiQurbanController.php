<?php

namespace App\Http\Controllers;

use App\Models\DistribusiQurban;
use App\Models\Kurban;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DistribusiQurbanController extends Controller
{
    // Tampilkan distribusi yang dibuat oleh admin yang login
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // Hanya tampilkan distribusi yang kurbannya dibuat oleh admin login
            $distribusis = DistribusiQurban::with(['kurban', 'panitia'])
                ->whereHas('kurban', function ($q) use ($user) {
                    $q->where('panitia_id', $user->id); // artinya admin_id pembuat kurban
                })
                ->get();
        } else {
            // Panitia hanya lihat distribusi yang dikirim ke dia
            $distribusis = DistribusiQurban::with(['kurban', 'panitia'])
                ->where('panitia_id', $user->id)
                ->get();
        }

        return view('backend.distribusi_qurban.index', compact('distribusis'));
    }

    // Tampilkan form tambah distribusi kurban (admin → panitia)
    public function create()
    {
        $admin = Auth::user();

        // Hanya kurban yang dibuat oleh admin ini
        $kurbans = Kurban::where('panitia_id', $admin->id)->get();

        // Hanya panitia yang dibuat oleh admin ini
        $panitias = User::where('role', 'panitia')->where('admin_id', $admin->id)->get();

        return view('backend.distribusi_qurban.create', compact('kurbans', 'panitias'));
    }

    // Simpan distribusi ke panitia
    public function store(Request $request)
    {
        $request->validate([
            'kurban_id' => 'required|exists:kurban,id',
            'panitia_id' => 'required|exists:user,id',
            'jumlah_daging' => 'required|numeric|min:0.01',
            'status' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);

        DistribusiQurban::create([
            'kurban_id' => $request->kurban_id,
            'panitia_id' => $request->panitia_id,
            'jumlah_daging' => $request->jumlah_daging,
            'status' => $request->status ?? 'pending',
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('backend.distribusi_qurban.index')->with('success', 'Distribusi ke panitia berhasil disimpan.');
    }

    // Edit distribusi ke panitia
    public function edit(DistribusiQurban $distribusi_qurban)
    {
        $admin = Auth::user();

        $kurbans = Kurban::where('panitia_id', $admin->id)->get();
        $panitias = User::where('role', 'panitia')->where('admin_id', $admin->id)->get();

        return view('backend.distribusi_qurban.edit', compact('distribusi_qurban', 'kurbans', 'panitias'));
    }

    // Update distribusi
    public function update(Request $request, DistribusiQurban $distribusi_qurban)
    {
        $request->validate([
            'kurban_id' => 'required|exists:kurban,id',
            'panitia_id' => 'required|exists:user,id',
            'jumlah_daging' => 'required|numeric|min:0.01',
            'status' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);

        $distribusi_qurban->update($request->all());

        return redirect()->route('backend.distribusi_qurban.index')->with('success', 'Distribusi berhasil diperbarui.');
    }

    // Hapus distribusi
    public function destroy(DistribusiQurban $distribusi_qurban)
    {
        $distribusi_qurban->delete();

        return redirect()->route('backend.distribusi_qurban.index')->with('success', 'Distribusi berhasil dihapus.');
    }
}
