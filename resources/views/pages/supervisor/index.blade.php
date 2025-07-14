@extends('layout.main')

@section('title')
Dashboard || Supervisor
@endsection

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Daftar Laporan</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama Admin</th>
                <th>Judul Laporan</th>
                <th>Tanggal Laporan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporan as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->admin->name ?? '-' }}</td>
                <td>{{ $item->judul }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                <td>
                    @if($item->status === 'terverifikasi')
                        <span class="badge bg-success">Terverifikasi</span>
                    @else
                        <span class="badge bg-warning text-dark">Belum Diverifikasi</span>
                    @endif
                </td>
                <td>
                    @if($item->status !== 'terverifikasi')
                    <form action="{{ route('supervisor.laporan.verifikasi', $item->id) }}" method="POST" onsubmit="return confirm('Verifikasi laporan ini?')">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-sm btn-primary">Verifikasi</button>
                    </form>
                    @else
                        <i class="text-muted">Sudah diverifikasi</i>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada laporan yang tersedia.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
