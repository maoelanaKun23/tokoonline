<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
</head>
<body>
    <h3>Data Mahasiswa</h3>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Kelas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataMahasiswa as $index => $mhs)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $mhs['nim'] }}</td>
                    <td>{{ $mhs['nama'] }}</td>
                    <td>{{ $mhs['kelas'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
