@extends('backend.v_layouts.app')

@section('content')
<div class="container">
    <h4>Import Data Warga dari Excel</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>@foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach</ul>
    </div>
    @endif

    <form action="{{ route('backend.warga.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="file">Pilih file Excel (.xlsx / .xls)</label>
            <input type="file" name="file" id="file" class="form-control" accept=".xlsx,.xls" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
        <a href="{{ route('backend.warga.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
