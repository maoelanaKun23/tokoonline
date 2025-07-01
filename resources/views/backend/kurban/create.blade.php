@extends('backend.v_layouts.app')

@section('content')
<div class="container-fluid">
    <h4>Tambah Kurban</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('backend.kurban.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="jenis">Jenis Kurban</label>
            <input type="text" name="jenis" id="jenis" class="form-control" value="{{ old('jenis') }}" required>
        </div>

        <div class="form-group">
            <label for="jumlah_daging">Jumlah Daging (kg)</label>
            <input type="number" step="0.01" name="jumlah_daging" id="jumlah_daging" class="form-control" value="{{ old('jumlah_daging') }}" required>
        </div>

        <div class="form-group">
            <label for="lokasi_id">Lokasi</label>
            <select name="lokasi_id" id="lokasi_id" class="form-control" required>
                <option value="">-- Pilih Lokasi --</option>
                @foreach($lokasi as $lok)
                <option value="{{ $lok->id }}" {{ old('lokasi_id') == $lok->id ? 'selected' : '' }}>
                    {{ $lok->nama_desa }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tahun">Tahun</label>
            <input type="number" name="tahun" id="tahun" class="form-control" value="{{ old('tahun', date('Y')) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('backend.kurban.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
