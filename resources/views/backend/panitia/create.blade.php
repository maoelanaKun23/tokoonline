@extends('backend.v_layouts.app')

@section('content')
<div class="container-fluid">
    <h4>Tambah Panitia</h4>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('backend.panitia.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('backend.panitia.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
