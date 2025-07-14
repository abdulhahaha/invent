@extends('layout.main')

@section('title', 'Tambah Barang Keluar')

@section('content')
<div class="container">
    <h2 class="mb-4">Form Tambah Barang Keluar</h2>

    <form action="{{ route('outbound.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="shipped_date" class="form-label">Tanggal Keluar</label>
            <input type="date" class="form-control" id="shipped_date" name="shipped_date" required>
        </div>

        <div class="mb-3">
            <label for="no_document" class="form-label">Nomor Dokumen</label>
            <input type="text" class="form-control" id="no_document" name="no_document" required>
        </div>

        <div class="mb-3">
            <label for="material" class="form-label">Kode Material</label>
            <input type="text" class="form-control" id="material" name="material" required>
        </div>

        <div class="mb-3">
            <label for="material_description" class="form-label">Deskripsi Material</label>
            <input type="text" class="form-control" id="material_description" name="material_description" required>
        </div>

        <div class="mb-3">
            <label for="inbound_qty" class="form-label">Jumlah Keluar</label>
            <input type="number" class="form-control" id="inbound_qty" name="inbound_qty" required>
        </div>

        <div class="mb-3">
            <label for="uom" class="form-label">Satuan (UOM)</label>
            <input type="text" class="form-control" id="uom" name="uom" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('outbound.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
