    @extends('layouts.admin')
    @section('content')
    <div class="card">
        <div class="card-header"><h3>Tambah Barang</h3></div>
        <div class="card-body">
            <form action="{{ route('barang.store') }}" method="POST">
                @csrf
                <div class="form-group"><label>Nama</label><input name="nama" class="form-control" required></div>
                <div class="form-group"><label>Kategori</label>
                    <select name="kategori_id" class="form-control" required>
                        @foreach($kategori as $k)<option value="{{ $k->id }}">{{ $k->nama }}</option>@endforeach
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4"><label>Harga Beli</label><input name="harga_beli" class="form-control" required></div>
                    <div class="form-group col-md-4"><label>Harga Jual</label><input name="harga_jual" class="form-control" required></div>
                    <div class="form-group col-md-4"><label>Stok</label><input name="stok" class="form-control" value="0"></div>
                </div>
                <div class="form-group"><label>Supplier</label>
                    <select name="supplier_id" class="form-control">
                        <option value="">-- Pilih --</option>
                        @foreach($supplier as $s)<option value="{{ $s->id }}">{{ $s->nama }}</option>@endforeach
                    </select>
                </div>
                <div class="form-group"><label>Satuan</label><input name="satuan" class="form-control" value="pcs"></div>
                <button class="btn btn-success mt-2">Simpan</button>
            </form>
        </div>
    </div>
    @endsection
