<h3>{{ $judul }}</h3>
<form action="{{ route('anggota.update', $anggota->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Nama</label><br>
    <input type="text" name="nama" value="{{ old('nama', $anggota->nama) }}"><br><br>
    
    <label>HP</label><br>
    <input type="text" name="hp" value="{{ old('hp', $anggota->hp) }}"><br><br>

    <button type="submit">Update</button>
    <a href="{{ route('anggota.index') }}"><button type="button">Batal</button></a>
</form>
