@extends('backend.v_layouts.app')

@section('content')
<div class="container-fluid">
    <h4>Tambah Lokasi</h4>

    <form action="{{ route('backend.lokasi.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama_desa" class="form-label">Nama Desa</label>
            <input type="text" name="nama_desa" id="nama_desa" class="form-control" value="{{ old('nama_desa') }}" required>
            @error('nama_desa')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="umr" class="form-label">UMR</label>
            <input type="number" name="umr" id="umr" class="form-control" value="{{ old('umr') }}" required>
            @error('umr')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="admin_id" class="form-label">Admin ID (Opsional)</label>
            <input type="number" name="admin_id" id="admin_id" class="form-control" value="{{ old('admin_id') }}">
            @error('admin_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button class="btn btn-primary" type="submit">Simpan</button>
        <a href="{{ route('backend.lokasi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
