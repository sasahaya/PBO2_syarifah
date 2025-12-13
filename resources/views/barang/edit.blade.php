@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header"><h3>Edit Barang</h3></div>
    <div class="card-body">
        <form action="{{ route('barang.update', $barang->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group"><label>Nama</label><input name="nama" class="form-control" value="{{ $barang->nama }}" required></div>
            <div class="form-group"><label>Kategori</label>
                <select name="kategori_id" class="form-control" required>
                    @foreach($kategori as $k)<option value="{{ $k->id }}" {{ $barang->kategori_id==$k->id?'selected':'' }}>{{ $k->nama }}</option>@endforeach
                </select>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4"><label>Harga Beli</label><input name="harga_beli" class="form-control" value="{{ $barang->harga_beli }}" required></div>
                <div class="form-group col-md-4"><label>Harga Jual</label><input name="harga_jual" class="form-control" value="{{ $barang->harga_jual }}" required></div>
                <div class="form-group col-md-4"><label>Stok</label><input name="stok" class="form-control" value="{{ $barang->stok }}"></div>
            </div>
            <div class="form-group"><label>Supplier</label>
                <select name="supplier_id" class="form-control">
                    <option value="">-- Pilih --</option>
                    @foreach($supplier as $s)<option value="{{ $s->id }}" {{ $barang->supplier_id==$s->id?'selected':'' }}>{{ $s->nama }}</option>@endforeach
                </select>
            </div>
            <div class="form-group"><label>Satuan</label><input name="satuan" class="form-control" value="{{ $barang->satuan }}"></div>
            <button class="btn btn-success mt-2">Update</button>
        </form>
    </div>
</div>
@endsection
