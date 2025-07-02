@extends('backend.v_layouts.app')

@section('content')
<div class="container-fluid">
    <h4>Edit Panitia</h4>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('backend.panitia.update', $panitia->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $panitia->name) }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $panitia->email) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('backend.panitia.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
