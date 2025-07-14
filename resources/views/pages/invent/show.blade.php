@extends('layout.main')

@section('title', 'Detail Barang')

@section('content')
<div class="container">
    <h2 class="mb-4">Detail Barang</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($barang->receive_date)->format('d M Y') }}</p>
            <p><strong>Location:</strong> {{ $barang->location }}</p>
            <p><strong>PLT ID:</strong> {{ $barang->plt_id }}</p>
            <p><strong>Material:</strong> {{ $barang->material }}</p>
            <p><strong>Material Description:</strong> {{ $barang->material_description }}</p>
            <p><strong>UOM:</strong> {{ $barang->uom }}</p>
            <p><strong>Unrestricted:</strong> {{ $barang->unrestricted }}</p>
            <p><strong>Blocked:</strong> {{ $barang->blocked }}</p>
            <p><strong>Remarks:</strong> {{ $barang->remarks }}</p>
        </div>
    </div>

    <a href="{{ route('inventory.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
