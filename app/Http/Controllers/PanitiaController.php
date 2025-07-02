<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PanitiaController extends Controller
{
    public function index()
    {
        $panitias = User::where('role', 'panitia')
            ->where('admin_id', Auth::id())
            ->get();

        return view('backend.panitia.index', compact('panitias'));
    }

    public function create()
    {
        return view('backend.panitia.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:user,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'panitia',
            'admin_id' => Auth::id(),
            'status'   => 'active',
        ]);

        return redirect()->route('backend.panitia.index')->with('success', 'Panitia berhasil ditambahkan.');
    }

    public function edit(User $panitia)
    {
        return view('backend.panitia.edit', compact('panitia'));
    }

    public function update(Request $request, User $panitia)
    {
        $request->validate([
            'name'  => 'required|string|max:100',
            'email' => 'required|email|unique:user,email,' . $panitia->id,
        ]);

        $panitia->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('backend.panitia.index')->with('success', 'Data panitia diperbarui.');
    }

    public function destroy(User $panitia)
    {
        $panitia->delete();

        return redirect()->route('backend.panitia.index')->with('success', 'Panitia dihapus.');
    }
}
