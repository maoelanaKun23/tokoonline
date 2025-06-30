@extends('backend.v_layouts.app')

@section('content')
<h3>Tambah Data Warga</h3>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('backend.warga.store') }}" method="POST">
    @csrf
    <div class="form-group mb-3">
        <label for="nama">Nama Lengkap</label>
        <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama') }}" required>
    </div>

    <div class="form-group mb-3">
        <label for="nik">NIK</label>
        <input type="text" name="nik" class="form-control" id="nik" value="{{ old('nik') }}" required>
    </div>

    <div class="form-group mb-3">
        <label for="alamat">Alamat</label>
        <textarea name="alamat" id="alamat" class="form-control" required>{{ old('alamat') }}</textarea>
    </div>

    <div class="form-row mb-3">
        <div class="col">
            <label for="rt">RT</label>
            <input type="text" name="rt" class="form-control" id="rt" value="{{ old('rt') }}" required>
        </div>
        <div class="col">
            <label for="rw">RW</label>
            <input type="text" name="rw" class="form-control" id="rw" value="{{ old('rw') }}" required>
        </div>
    </div>

    <div class="form-group mb-3">
        <label for="desa">Desa</label>
        <input type="text" name="desa" class="form-control" id="desa" value="{{ old('desa') }}" required>
    </div>

    <div class="form-group">
        <label for="gaji">Gaji</label>
        <input type="number" step="0.01" name="gaji" id="gaji" class="form-control" value="{{ old('gaji') }}" required>
    </div>


    <div class="form-group mb-3">
        <label for="lokasi_id">Lokasi</label>
        <label for="lokasi_id">Pilih Lokasi</label>
        <select name="lokasi_id" id="lokasi_id" class="form-control" required>
            <option value="">-- Pilih Lokasi --</option>
            @foreach($lokasi as $lok)
            <option value="{{ $lok->id }}" {{ (old('lokasi_id', $warga->lokasi_id ?? '') == $lok->id) ? 'selected' : '' }}>
                {{ $lok->nama_desa }}
            </option>
            @endforeach
        </select>

    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('backend.warga.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection