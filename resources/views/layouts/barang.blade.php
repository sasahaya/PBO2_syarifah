@extends('layouts.admin')

@push('css')
<style>
    .card {
        border-radius: 15px;
        border: none;
    }
    .table thead {
        background: #4f46e5;
        color: white;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">

    <h3 class="mb-4"><i class="bi bi-box"></i> {{ $title }}</h3>

    <div class="card p-4 shadow-sm">
        @yield('barang-content')
    </div>

</div>
@endsection
