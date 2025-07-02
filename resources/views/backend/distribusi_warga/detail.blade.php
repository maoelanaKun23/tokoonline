@extends('backend.v_layouts.app')

@section('content')
<div class="container">
    <h4>Detail Warga RW {{ $distribusi->rw }}</h4>
    <p>Distribusi: {{ $distribusi->distribusi->kurban->jenis ?? '-' }} - {{ $distribusi->jumlah_daging }} kg</p>

    <table class="table">
        <thead><tr><th>Nama</th><th>Alamat</th></tr></thead>
        <tbody>
            @foreach ($wargas as $w)
            <tr>
                <td>{{ $w->nama }}</td>
                <td>{{ $w->alamat }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('backend.distribusi_warga.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
