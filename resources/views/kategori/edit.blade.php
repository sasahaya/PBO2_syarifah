@extends('layouts.admin')
@section('content')
<div class="card"><div class="card-header"><h3>Edit Kategori</h3></div>
<div class="card-body">
    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">@csrf @method('PUT')
        <div class="form-group"><label>Nama</label><input name="nama" class="form-control" value="{{ $kategori->nama }}" required></div>
        <button class="btn btn-success mt-2">Update</button>
    </form>
</div></div>
@endsection
