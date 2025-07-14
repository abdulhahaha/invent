@extends('layout.main')

@section('title', 'Laporan Barang Keluar')

@section('content')
<div class="container">
    <h2 class="mb-4">Laporan Barang Keluar</h2>

    <!-- Filter Tanggal -->
    <form method="GET" action="{{ route('outbound.laporan') }}" class="row g-3 mb-4">
        <div class="col-md-3">
            <label for="start_date" class="form-label">Dari Tanggal</label>
            <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
        </div>
        <div class="col-md-3">
            <label for="end_date" class="form-label">Sampai Tanggal</label>
            <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
        </div>
        <div class="col-md-2 align-self-end">
            <button class="btn btn-info w-100">Filter</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Dokumen</th>
                    <th>Material</th>
                    <th>Deskripsi</th>
                    <th>Qty</th>
                    <th>UOM</th>
                    <th>Lokasi</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($outbounds as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->shipped_date)->format('d M Y') }}</td>
                    <td>{{ $item->no_document }}</td>
                    <td>{{ $item->material }}</td>
                    <td>{{ $item->material_description }}</td>
                    <td>{{ $item->inbound_qty }}</td>
                    <td>{{ $item->uom }}</td>
                    <td>{{ $item->location }}</td>
                    <td>{{ $item->remarks }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center">Tidak ada data ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
