@extends('layouts.admin')
@section('content')
<div class="card"><div class="card-header"><h3>Edit Supplier</h3></div>
<div class="card-body">
    <form action="{{ route('supplier.update', $supplier->id) }}" method="POST">@csrf @method('PUT')
        <div class="form-group"><label>Nama</label><input name="nama" class="form-control" value="{{ $supplier->nama }}" required></div>
        <div class="form-group"><label>Telepon</label><input name="telepon" class="form-control" value="{{ $supplier->telepon }}"></div>
        <div class="form-group"><label>Alamat</label><textarea name="alamat" class="form-control">{{ $supplier->alamat }}</textarea></div>
        <button class="btn btn-success mt-2">Update</button>
    </form>
</div></div>
@endsection
