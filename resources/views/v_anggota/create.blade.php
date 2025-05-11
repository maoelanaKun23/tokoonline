<h3>{{ $judul }}</h3>
<form action="{{ route('anggota.store') }}" method="POST">
    @csrf
    <label>Nama</label><br>
    <input type="text" name="nama" value="{{ old('nama') }}"><br><br>
    
    <label>HP</label><br>
    <input type="text" name="hp" value="{{ old('hp') }}"><br><br>

    <button type="submit">Simpan</button>
    <a href="{{ route('anggota.index') }}"><button type="button">Batal</button></a>
</form>
