@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header"><h3>Supplier</h3><div class="card-tools"><a href="{{ route('supplier.create') }}" class="btn btn-sm btn-primary">Tambah</a></div></div>
    <div class="card-body">
        <table class="table table-bordered"><thead><tr><th>Nama</th><th>Telepon</th><th>Aksi</th></tr></thead>
        <tbody>@foreach($supplier as $s)<tr><td>{{ $s->nama }}</td><td>{{ $s->telepon }}</td>
        <td><a href="{{ route('supplier.edit', $s->id) }}" class="btn btn-sm btn-warning">Edit</a>
        <form action="{{ route('supplier.destroy', $s->id) }}" method="POST" style="display:inline">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Hapus</button></form></td></tr>@endforeach</tbody></table>
        <div class="mt-2">{{ $supplier->links() }}</div>
    </div>
</div>
@endsection
