@extends('backend.v_layouts.app')

@section('content')
<div class="container-fluid">
    <h4>Data Kurban</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('backend.kurban.create') }}" class="btn btn-success mb-3">Tambah Kurban</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis</th>
                <th>Jumlah Daging (kg)</th>
                <th>Lokasi</th>
                <th>Admin</th>
                <th>Tahun</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kurbans as $index => $kurban)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $kurban->jenis }}</td>
                <td>{{ $kurban->jumlah_daging }}</td>
                <td>{{ $kurban->lokasi->nama_desa ?? '-' }}</td>
                <td>{{ $kurban->panitia->name ?? '-' }}</td>
                <td>{{ $kurban->tahun }}</td>
                <td>
                    <a href="{{ route('backend.kurban.edit', $kurban->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('backend.kurban.destroy', $kurban->id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @if($kurbans->isEmpty())
            <tr>
                <td colspan="7" class="text-center">Data Kurban belum tersedia.</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
