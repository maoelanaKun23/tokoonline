@extends('backend.v_layouts.app')

@section('content')
<div class="container-fluid">
    <h4>Edit Distribusi ke Warga</h4>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('backend.distribusi_warga.update', $distribusi_warga->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="distribusi_id">Pilih Distribusi (Panitia)</label>
            <select name="distribusi_id" id="distribusi_id" class="form-control" required>
                <option value="">-- Pilih Distribusi --</option>
                @foreach ($distribusiQurban as $distribusi)
                    <option value="{{ $distribusi->id }}" {{ (old('distribusi_id') ?? $distribusi_warga->distribusi_id) == $distribusi->id ? 'selected' : '' }}>
                        {{ $distribusi->kurban->jenis ?? '-' }} ({{ number_format($distribusi->jumlah_daging, 2) }} kg)
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="warga_id">Pilih Warga</label>
            <select name="warga_id" id="warga_id" class="form-control" required>
                <option value="">-- Pilih Warga --</option>
                @foreach ($wargas as $warga)
                    <option value="{{ $warga->id }}" {{ (old('warga_id') ?? $distribusi_warga->warga_id) == $warga->id ? 'selected' : '' }}>
                        {{ $warga->nama ?? $warga->nama_lengkap ?? 'Nama Warga' }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="jumlah_daging">Jumlah Daging (kg)</label>
            <input type="number" step="0.01" name="jumlah_daging" id="jumlah_daging" class="form-control" value="{{ old('jumlah_daging') ?? $distribusi_warga->jumlah_daging }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="pending" {{ (old('status') ?? $distribusi_warga->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="terima" {{ (old('status') ?? $distribusi_warga->status) == 'terima' ? 'selected' : '' }}>Terima</option>
                <option value="tolak" {{ (old('status') ?? $distribusi_warga->status) == 'tolak' ? 'selected' : '' }}>Tolak</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="keterangan">Keterangan (opsional)</label>
            <textarea name="keterangan" id="keterangan" class="form-control" rows="3">{{ old('keterangan') ?? $distribusi_warga->keterangan }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('backend.distribusi_warga.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
