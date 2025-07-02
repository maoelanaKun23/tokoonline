<!DOCTYPE html>
<html>
<head>
    <title>Detail Distribusi RW {{ $distribusi->rw }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        h3 { margin-bottom: 10px; }
    </style>
</head>
<body>
    <h3>Detail Distribusi RW {{ $distribusi->rw }}</h3>
    <p>Jenis Kurban: {{ $distribusi->distribusi->kurban->jenis ?? '-' }}</p>
    <p>Jumlah Daging: {{ $distribusi->jumlah_daging }} kg</p>

    <h4>Warga Prioritas</h4>
    <table>
        <thead>
            <tr><th>Nama</th><th>Alamat</th><th>Gaji</th></tr>
        </thead>
        <tbody>
            @foreach ($prioritas as $w)
            <tr>
                <td>{{ $w->nama }}</td>
                <td>{{ $w->alamat }}</td>
                <td>{{ number_format($w->gaji, 0) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Warga Non-Prioritas</h4>
    <table>
        <thead>
            <tr><th>Nama</th><th>Alamat</th><th>Gaji</th></tr>
        </thead>
        <tbody>
            @foreach ($nonPrioritas as $w)
            <tr>
                <td>{{ $w->nama }}</td>
                <td>{{ $w->alamat }}</td>
                <td>{{ number_format($w->gaji, 0) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
