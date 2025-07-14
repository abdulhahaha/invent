@extends('layout.main')

@section('title', 'Laporan Manajemen Barang')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Laporan Manajemen Barang</h2>

    <!-- Filter Tanggal -->
    <form method="GET" action="{{ route('invent.laporan') }}" class="row g-3 mb-4">
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

    <!-- Tabel Laporan Barang -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Lokasi</th>
                    <th>PLT ID</th>
                    <th>Material</th>
                    <th>Deskripsi</th>
                    <th>UOM</th>
                    <th>Jumlah (Unrestricted)</th>
                    <th>Jumlah (Blocked)</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($inventory as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->receive_date)->format('d-m-Y') }}</td>
                    <td>{{ $item->location }}</td>
                    <td>{{ $item->plt_id }}</td>
                    <td>{{ $item->material }}</td>
                    <td>{{ $item->material_description }}</td>
                    <td>{{ $item->uom }}</td>
                    <td>{{ $item->unrestricted }}</td>
                    <td>{{ $item->blocked }}</td>
                    <td>{{ $item->remarks }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="10">Data tidak ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
