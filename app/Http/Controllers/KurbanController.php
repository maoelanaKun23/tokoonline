<?php

namespace App\Http\Controllers;

use App\Models\Kurban;
use App\Models\Lokasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KurbanController extends Controller
{
    // public function index()
    // {
    //     // Bisa filter kurban hanya milik admin login saja jika perlu:
    //     // $kurbans = Kurban::with(['lokasi', 'panitia'])->where('panitia_id', Auth::id())->get();

    //     // Atau ambil semua kurban (sesuai kebutuhan)
    //     $kurbans = Kurban::with(['lokasi', 'panitia'])->get();

    //     return view('backend.kurban.index', compact('kurbans'));
    // }
    public function index()
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            // Kalau admin, tampilkan semua kurban yang dia buat (panitia_id = admin id)
            $kurbans = Kurban::with(['lokasi', 'panitia'])
                ->where('panitia_id', $user->id)
                ->get();
        } elseif ($user->role == 'panitia') {
            // Kalau panitia, tampilkan kurban yang dibuat oleh admin yang membuat akun panitia ini
            $kurbans = Kurban::with(['lokasi', 'panitia'])
                ->where('panitia_id', $user->admin_id) // admin_id di user panitia
                ->get();
        } else {
            // Role lain bisa di-handle sesuai kebutuhan, misal kosong atau semua data
            $kurbans = collect(); // kosong
        }

        return view('backend.kurban.index', compact('kurbans'));
    }


    public function create()
    {
        $lokasi = Lokasi::all();
        // Hapus panitias, karena gak perlu pilih panitia lagi
        // $panitias = User::where('role', 'panitia')->get();

        return view('backend.kurban.create', compact('lokasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|string|max:50',
            'jumlah_daging' => 'required|numeric|min:0',
            'lokasi_id' => 'required|exists:lokasi,id',
            'tahun' => 'required|integer|min:2000',
            // 'panitia_id' dihapus dari validasi karena diisi otomatis
        ]);

        Kurban::create([
            'jenis' => $request->jenis,
            'jumlah_daging' => $request->jumlah_daging,
            'lokasi_id' => $request->lokasi_id,
            'tahun' => $request->tahun,
            'panitia_id' => Auth::id(), // isi dengan user id yang login (admin)
        ]);

        return redirect()->route('backend.kurban.index')->with('success', 'Data kurban berhasil ditambahkan.');
    }

    public function edit(Kurban $kurban)
    {
        $lokasi = Lokasi::all();
        // Hapus panitias
        // $panitias = User::where('role', 'panitia')->get();

        return view('backend.kurban.edit', compact('kurban', 'lokasi'));
    }

    public function update(Request $request, Kurban $kurban)
    {
        $request->validate([
            'jenis' => 'required|string|max:50',
            'jumlah_daging' => 'required|numeric|min:0',
            'lokasi_id' => 'required|exists:lokasi,id',
            'tahun' => 'required|integer|min:2000',
            // 'panitia_id' dihapus dari validasi dan update
        ]);

        $kurban->update([
            'jenis' => $request->jenis,
            'jumlah_daging' => $request->jumlah_daging,
            'lokasi_id' => $request->lokasi_id,
            'tahun' => $request->tahun,
            // panitia_id tetap tidak diupdate manual
        ]);

        return redirect()->route('backend.kurban.index')->with('success', 'Data kurban berhasil diperbarui.');
    }

    public function destroy(Kurban $kurban)
    {
        $kurban->delete();

        return redirect()->route('backend.kurban.index')->with('success', 'Data kurban berhasil dihapus.');
    }
}
