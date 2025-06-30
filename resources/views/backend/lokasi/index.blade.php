@extends('backend.v_layouts.app')

@section('content')
<div class="container-fluid">
    <h4>Data Lokasi</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('backend.lokasi.create') }}" class="btn btn-primary mb-3">Tambah Lokasi</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Desa</th>
                <th>UMR</th>
                <th>Admin ID</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lokasis as $index => $lokasi)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $lokasi->nama_desa }}</td>
                <td>{{ $lokasi->umr }}</td>
                <td>{{ $lokasi->admin_id }}</td>
                <td>
                    <a href="{{ route('backend.lokasi.edit', $lokasi->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('backend.lokasi.destroy', $lokasi->id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin ingin menghapus lokasi ini?')" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
