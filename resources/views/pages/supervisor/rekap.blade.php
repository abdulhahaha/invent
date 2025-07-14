@extends('layout.main')

@section('title', 'Rekapitulasi Laporan || Supervisor')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">Rekapitulasi Laporan Terverifikasi</h2>

    <!-- Filter Tanggal -->
    <form method="GET" action="{{ route('supervisor.rekap') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="start_date" class="form-label">Dari Tanggal</label>
            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
        </div>
        <div class="col-md-4">
            <label for="end_date" class="form-label">Sampai Tanggal</label>
            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
        </div>
        <div class="col-md-4 align-self-end">
            <button type="submit" class="btn btn-info w-100">Tampilkan</button>
        </div>
    </form>

    <!-- Tabel Rekap Laporan -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Admin</th>
                    <th>Judul Laporan</th>
                    <th>Tanggal</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laporan as $index => $laporan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $laporan->admin->name }}</td>
                    <td>{{ $laporan->judul }}</td>
                    <td>{{ \Carbon\Carbon::parse($laporan->tanggal)->format('d M Y') }}</td>
                    <td>{{ $laporan->catatan ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada laporan terverifikasi dalam rentang waktu ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
