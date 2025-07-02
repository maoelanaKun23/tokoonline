@extends('backend.v_layouts.app')

@section('content')
<div class="container-fluid">
    <h4>Tambah Distribusi Qurban</h4>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('backend.distribusi_qurban.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="kurban_id">Pilih Kurban</label>
            <select name="kurban_id" id="kurban_id" class="form-control" required>
                <option value="">-- Pilih Kurban --</option>
                @foreach ($kurbans as $kurban)
                    <option value="{{ $kurban->id }}" {{ old('kurban_id') == $kurban->id ? 'selected' : '' }}>
                        {{ $kurban->jenis }} - {{ $kurban->tahun }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="panitia_id">Pilih Panitia</label>
            <select name="panitia_id" id="panitia_id" class="form-control" required>
                <option value="">-- Pilih Panitia --</option>
                @foreach ($panitias as $panitia)
                    <option value="{{ $panitia->id }}" {{ old('panitia_id') == $panitia->id ? 'selected' : '' }}>
                        {{ $panitia->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="jumlah_daging">Jumlah Daging (kg)</label>
            <input type="number" step="0.01" name="jumlah_daging" id="jumlah_daging" class="form-control" value="{{ old('jumlah_daging') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="terima" {{ old('status') == 'terima' ? 'selected' : '' }}>Terima</option>
                <option value="tolak" {{ old('status') == 'tolak' ? 'selected' : '' }}>Tolak</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="keterangan">Keterangan (opsional)</label>
            <textarea name="keterangan" id="keterangan" class="form-control" rows="3">{{ old('keterangan') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('backend.distribusi_qurban.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
