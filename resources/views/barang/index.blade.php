@extends('layouts.admin', ['title' => 'Data Barang'])

@section('content')

<div class="card p-4 shadow-sm">
    <div class="d-flex justify-content-between mb-3">
        <h5 class="fw-bold">Daftar Barang</h5>
        <a href="barang/create" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Barang
        </a>
    </div>

    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Harga</th>
                <th width="120">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barang as $b)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $b->nama }}</td>
                <td>{{ $b->kategori->nama }}</td>
                <td>{{ $b->stok }}</td>
                <td>Rp{{ number_format($b->harga_jual) }}</td>
                <td>
                    <a href="barang/{{ $b->id }}/edit" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <a href="barang/{{ $b->id }}/delete" class="btn btn-danger btn-sm">
                        <i class="bi bi-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
