@extends('backend.v_layouts.app')

@section('content')
<div class="container-fluid">
    <h4>Tambah Distribusi ke Warga</h4>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('backend.distribusi_warga.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="distribusi_id">Pilih Distribusi (Panitia)</label>
            <select name="distribusi_id" id="distribusi_id" class="form-control" required>
                <option value="">-- Pilih Distribusi --</option>
                @foreach ($distribusiQurban as $distribusi)
                <option value="{{ $distribusi->id }}" {{ old('distribusi_id') == $distribusi->id ? 'selected' : '' }}>
                    {{ $distribusi->kurban->jenis ?? '-' }} ({{ number_format($distribusi->jumlah_daging, 2) }} kg)
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="rw">Pilih RW</label>
            <select name="rw" id="rw" class="form-control" required>
                <option value="">-- Pilih RW --</option>
                @foreach ($rws as $rw)
                <option value="{{ $rw }}">{{ $rw }}</option>
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
        <a href="{{ route('backend.distribusi_warga.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection