<?php

namespace App\Http\Controllers;

use App\Models\DistribusiWarga;
use App\Models\DistribusiQurban;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;


class DistribusiWargaController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Hanya distribusi warga dari distribusi milik panitia yang login
        $distribusis = DistribusiWarga::with(['warga', 'distribusi.kurban'])
            ->whereHas('distribusi', function ($q) use ($user) {
                $q->where('panitia_id', $user->id);
            })
            ->get();

        return view('backend.distribusi_warga.index', compact('distribusis'));
    }

    public function create()
    {
        $user = Auth::user();
        $distribusiQurban = DistribusiQurban::where('panitia_id', $user->id)->get();
        $rws = Warga::distinct()->pluck('rw');

        return view('backend.distribusi_warga.create', compact('distribusiQurban', 'rws'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'distribusi_id' => 'required|exists:distribusi_qurban,id',
            'rw' => 'required|string',
            'jumlah_daging' => 'required|numeric|min:0.01',
            'status' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);

        // Cek apakah sudah pernah disimpan distribusi untuk RW ini
        $existing = DistribusiWarga::where('distribusi_id', $request->distribusi_id)
            ->where('rw', $request->rw)
            ->first();

        if ($existing) {
            return redirect()->back()->withErrors('Distribusi ke RW ini sudah pernah dibuat.');
        }

        DistribusiWarga::create([
            'distribusi_id' => $request->distribusi_id,
            'rw' => $request->rw,
            'jumlah_daging' => $request->jumlah_daging,
            'status' => $request->status ?? 'pending',
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('backend.distribusi_warga.index')->with('success', 'Distribusi RW berhasil disimpan.');
    }


    public function destroy(DistribusiWarga $distribusiWarga)
    {
        $distribusiWarga->delete();
        return redirect()->route('backend.distribusi_warga.index')->with('success', 'Distribusi warga berhasil dihapus.');
    }

    public function showDetailRW($id)
    {
        $distribusi = DistribusiWarga::with('distribusi.kurban')->findOrFail($id);

        $prioritas = \App\Models\Warga::where('rw', $distribusi->rw)
            ->where('prioritas', 1)
            ->orderBy('gaji', 'asc')
            ->get();

        $nonPrioritas = \App\Models\Warga::where('rw', $distribusi->rw)
            ->where('prioritas', 0)
            ->orderBy('gaji', 'asc')
            ->get();

        return view('backend.distribusi_warga.detail_rw', compact('distribusi', 'prioritas', 'nonPrioritas'));
    }

    public function downloadDetailPdf($id)
    {
        $distribusi = DistribusiWarga::with('distribusi.kurban')->findOrFail($id);

        $prioritas = \App\Models\Warga::where('rw', $distribusi->rw)
            ->where('prioritas', 1)
            ->orderBy('gaji', 'asc')
            ->get();

        $nonPrioritas = \App\Models\Warga::where('rw', $distribusi->rw)
            ->where('prioritas', 0)
            ->orderBy('gaji', 'asc')
            ->get();

        $pdf = Pdf::loadView('backend.distribusi_warga.detail_rw_pdf', compact('distribusi', 'prioritas', 'nonPrioritas'));

        return $pdf->download('detail_rw_' . $distribusi->rw . '.pdf');
    }
    
}
