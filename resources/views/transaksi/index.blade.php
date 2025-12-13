@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header"><h3>Transaksi</h3></div>
    <div class="card-body">
        <form action="{{ route('transaksi.store') }}" method="POST" class="mb-3">@csrf
            <div class="form-row">
                <div class="form-group col-md-4"><label>Barang</label>
                    <select name="barang_id" class="form-control">@foreach($barang as $b)<option value="{{ $b->id }}">{{ $b->nama }} (Stok: {{ $b->stok }})</option>@endforeach</select>
                </div>
                <div class="form-group col-md-2"><label>Jenis</label><select name="jenis" class="form-control"><option value="masuk">Masuk</option><option value="keluar">Keluar</option></select></div>
                <div class="form-group col-md-2"><label>Jumlah</label><input type="number" name="jumlah" class="form-control" value="1" min="1"></div>
                <div class="form-group col-md-4"><label>Keterangan</label><input name="keterangan" class="form-control"></div>
            </div>
            <button class="btn btn-primary mt-2">Simpan Transaksi</button>
        </form>

        <table class="table table-bordered">
            <thead><tr><th>Tanggal</th><th>Barang</th><th>Jenis</th><th>Jumlah</th><th>Keterangan</th></tr></thead>
            <tbody>
                @foreach($transaksi as $t)
                <tr>
                    <td>{{ $t->created_at }}</td>
                    <td>{{ $t->barang->nama }}</td>
                    <td>{{ $t->jenis }}</td>
                    <td>{{ $t->jumlah }}</td>
                    <td>{{ $t->keterangan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-2">{{ $transaksi->links() }}</div>
    </div>
</div>
@endsection
