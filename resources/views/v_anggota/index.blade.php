<h3>{{ $judul }}</h3>
<a href="{{ route('anggota.create') }}"><button type="button">Tambah</button></a>
<table border="1" width="60%">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>HP</th>
        <th>Aksi</th>
    </tr>
    @foreach ($anggota as $row)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $row->nama }}</td>
            <td>{{ $row->hp }}</td>
            <td>
                <a href="{{ route('anggota.edit', $row->id) }}"><button>Ubah</button></a>
                <form action="{{ route('anggota.destroy', $row->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
