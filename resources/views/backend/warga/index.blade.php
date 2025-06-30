@extends('backend.v_layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Warga</h4>
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="mb-3 text-right">
                        <a href="{{ route('backend.warga.create') }}" class="btn btn-success">Tambah Warga</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Alamat</th>
                                    <th>RT</th>
                                    <th>RW</th>
                                    <th>Gaji</th>
                                    <th>Lokasi</th>
                                    <th>Prioritas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($warga as $index => $warga)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $warga->nama }}</td>
                                        <td>{{ $warga->nik }}</td>
                                        <td>{{ $warga->alamat }}</td>
                                        <td>{{ $warga->rt }}</td>
                                        <td>{{ $warga->rw }}</td>
                                        <td>{{ $warga->gaji }}</td>
                                        <td>{{ $warga->lokasi->nama_desa ?? '-' }}</td>
                                        <td>{{ $warga->prioritas ? 'Ya' : 'Tidak' }}</td>
                                        <td>
                                            <a href="{{ route('backend.warga.edit', $warga->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('backend.warga.destroy', $warga->id) }}" method="POST" style="display:inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
