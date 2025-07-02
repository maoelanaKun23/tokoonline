@extends('backend.v_layouts.app')

@section('content')
<div class="container">
    <h4>Detail Warga RW {{ $distribusi->rw }}</h4>
    <p>Kurban: {{ $distribusi->distribusi->kurban->jenis ?? '-' }} - {{ $distribusi->jumlah_daging }} kg</p>

    <h5>Warga Prioritas</h5>
    <table class="table table-bordered">
        <thead>
            <tr><th>Nama</th><th>Alamat</th><th>Gaji</th></tr>
        </thead>
        <tbody>
            @forelse ($prioritas as $w)
                <tr>
                    <td>{{ $w->nama }}</td>
                    <td>{{ $w->alamat }}</td>
                    <td>{{ number_format($w->gaji, 0) }}</td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center">Tidak ada warga prioritas</td></tr>
            @endforelse
        </tbody>
    </table>

    <h5>Warga Non-Prioritas</h5>
    <table class="table table-bordered">
        <thead>
            <tr><th>Nama</th><th>Alamat</th><th>Gaji</th></tr>
        </thead>
        <tbody>
            @forelse ($nonPrioritas as $w)
                <tr>
                    <td>{{ $w->nama }}</td>
                    <td>{{ $w->alamat }}</td>
                    <td>{{ number_format($w->gaji, 0) }}</td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center">Tidak ada warga non-prioritas</td></tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('backend.distribusi_warga.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
