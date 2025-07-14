@extends('layout.main')

@section('title', 'Laporan Barang Masuk')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Laporan Barang Masuk</h2>
    <form method="GET" action="{{ route('inbound.laporan') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="start_date" class="form-label">Dari Tanggal</label>
            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
        </div>
        <div class="col-md-4">
            <label for="end_date" class="form-label">Sampai Tanggal</label>
            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
        </div>
        <div class="col-md-4 align-self-end">
            <button type="submit" class="btn btn-info w-100">Filter</button>
        </div>
    </form>

    <!-- Tabel Laporan -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
            <thead class="table-light">
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>No. Dokumen</th>
                    <th>Consignee</th>
                    <th>Material</th>
                    <th>Deskripsi</th>
                    <th>Qty</th>
                    <th>UOM</th>
                    <th>PLT ID</th>
                    <th>Lokasi</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($inbounds as $inbound)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ \Carbon\Carbon::parse($inbound->receive_date)->format('d M Y') }}</td>
                    <td>{{ $inbound->no_document }}</td>
                    <td>{{ $inbound->consignee }}</td>
                    <td>{{ $inbound->material }}</td>
                    <td>{{ $inbound->material_description }}</td>
                    <td>{{ $inbound->inbound_qty }}</td>
                    <td>{{ $inbound->uom }}</td>
                    <td>{{ $inbound->plt_id }}</td>
                    <td>{{ $inbound->location }}</td>
                    <td>{{ $inbound->remarks }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="11">Tidak ada data ditemukan pada rentang tanggal tersebut.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
