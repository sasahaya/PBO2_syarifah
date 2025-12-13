@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header"><h3>Kategori</h3><div class="card-tools"><a href="{{ route('kategori.create') }}" class="btn btn-sm btn-primary">Tambah</a></div></div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead><tr><th>Nama</th><th>Aksi</th></tr></thead>
            <tbody>
                @foreach($kategori as $k)<tr><td>{{ $k->nama }}</td>
                <td><a href="{{ route('kategori.edit', $k->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('kategori.destroy', $k->id) }}" method="POST" style="display:inline">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Hapus</button></form></td></tr>@endforeach
            </tbody>
        </table>
        <div class="mt-2">{{ $kategori->links() }}</div>
    </div>
</div>
@endsection
