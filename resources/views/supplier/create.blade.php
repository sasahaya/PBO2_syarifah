@extends('layouts.admin')
@section('content')
<div class="card"><div class="card-header"><h3>Tambah Supplier</h3></div>
<div class="card-body">
    <form action="{{ route('supplier.store') }}" method="POST">@csrf
        <div class="form-group"><label>Nama</label><input name="nama" class="form-control" required></div>
        <div class="form-group"><label>Telepon</label><input name="telepon" class="form-control"></div>
        <div class="form-group"><label>Alamat</label><textarea name="alamat" class="form-control"></textarea></div>
        <button class="btn btn-success mt-2">Simpan</button>
    </form>
</div></div>
@endsection
