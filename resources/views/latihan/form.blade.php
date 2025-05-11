<!DOCTYPE html>
<html>
<head>
    <title>Form Mahasiswa</title>
</head>
<body>
    <form action="#" method="post">
        @csrf
        <p>
            <label for="nim">NIM</label><br>
            <input type="text" name="nim" id="nim">
        </p>
        <p>
            <label for="nama">Nama Lengkap</label><br>
            <input type="text" name="nama" id="nama">
        </p>
        <p>
            <label for="kelas">Kelas</label><br>
            <input type="text" name="kelas" id="kelas">
        </p>
        <p>
            <button type="submit">Simpan</button>
        </p>
    </form>
</body>
</html>
