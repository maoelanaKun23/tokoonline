@extends('backend.v_layouts.app')

@section('content')
<div class="container-fluid">
    <h4>Daftar Distribusi Qurban</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('backend.distribusi_qurban.create') }}" class="btn btn-primary mb-3">Tambah Distribusi</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Kurban</th>
                <th>Panitia</th>
                <th>Jumlah Daging (kg)</th>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($distribusis as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->kurban->jenis ?? '-' }}</td>
                <td>{{ $d->panitia->name ?? '-' }}</td>
                <td>{{ number_format($d->jumlah_daging, 2) }}</td>
                <td>{{ ucfirst($d->status) }}</td>
                <td>{{ $d->keterangan ?? '-' }}</td>
                <td>
                    <a href="{{ route('backend.distribusi_qurban.edit', $d->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('backend.distribusi_qurban.destroy', $d->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin hapus distribusi ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>

                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center">Tidak ada data distribusi</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
