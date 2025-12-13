@extends('layouts.admin')
@section('content')
<div class="card"><div class="card-header"><h3>Tambah Kategori</h3></div>
<div class="card-body">
    <form action="{{ route('kategori.store') }}" method="POST">@csrf
        <div class="form-group"><label>Nama</label><input name="nama" class="form-control" required></div>
        <button class="btn btn-success mt-2">Simpan</button>
    </form>
</div></div>
@endsection
