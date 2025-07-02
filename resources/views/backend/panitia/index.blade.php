@extends('backend.v_layouts.app')

@section('content')
<div class="container-fluid">
    <h4>Daftar Panitia</h4>

    <a href="{{ route('backend.panitia.create') }}" class="btn btn-success mb-3">Tambah Panitia</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($panitias as $panitia)
                <tr>
                    <td>{{ $panitia->name }}</td>
                    <td>{{ $panitia->email }}</td>
                    <td>{{ $panitia->status }}</td>
                    <td>
                        <a href="{{ route('backend.panitia.edit', $panitia->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('backend.panitia.destroy', $panitia->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin hapus panitia ini?')" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center">Belum ada panitia.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
