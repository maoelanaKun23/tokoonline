@extends('backend.v_layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Warga</h4>
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="mb-3 text-right">
                        <a href="{{ route('backend.warga.create') }}" class="btn btn-success">Tambah Warga</a>
                        <!-- Tombol untuk buka modal upload -->
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#importExcelModal">
                            Import Data Warga (Excel)
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Alamat</th>
                                    <th>RT</th>
                                    <th>RW</th>
                                    <th>Gaji</th>
                                    <th>Lokasi</th>
                                    <th>Prioritas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($warga as $index => $warga)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $warga->nama }}</td>
                                        <td>{{ $warga->nik }}</td>
                                        <td>{{ $warga->alamat }}</td>
                                        <td>{{ $warga->rt }}</td>
                                        <td>{{ $warga->rw }}</td>
                                        <td>{{ $warga->gaji }}</td>
                                        <td>{{ $warga->lokasi->nama_desa ?? '-' }}</td>
                                        <td>{{ $warga->prioritas ? 'Ya' : 'Tidak' }}</td>
                                        <td>
                                            <a href="{{ route('backend.warga.edit', $warga->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('backend.warga.destroy', $warga->id) }}" method="POST" style="display:inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Import Excel -->
<div class="modal fade" id="importExcelModal" tabindex="-1" role="dialog" aria-labelledby="importExcelModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('backend.warga.import') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="importExcelModalLabel">Import Data Warga dari Excel</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="excelFile">Pilih file Excel (.xls, .xlsx)</label>
            <input type="file" name="excel_file" class="form-control" id="excelFile" accept=".xls,.xlsx" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Upload</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
