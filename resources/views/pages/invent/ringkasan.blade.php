@extends('layout.main')

@section('title', 'Ketersediaan Penyimpanan')

@section('content')
<div class="container">

    <h2 class="mb-4">Ketersediaan Penyimpanan per Lokasi</h2>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Tabel Rekap Lokasi --}}
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Lokasi</th>
                    <th>Total Unrestricted</th>
                    <th>Total Blocked</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rekap as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->location }}</td>
                    <td>{{ $item->total_unrestricted }}</td>
                    <td>{{ $item->total_blocked }}</td>
                    <td>
                        <!-- Tombol Modal -->
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal{{ $index }}">
                            Kelola
                        </button>

                        <!-- Modal Kelola Stok -->
                        <div class="modal fade" id="updateModal{{ $index }}" tabindex="-1" aria-labelledby="modalLabel{{ $index }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('invent.ringkasan.update') }}" method="POST" class="modal-content">
                                    @csrf
                                    <input type="hidden" name="location" value="{{ $item->location }}">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel{{ $index }}">Kelola Stok: {{ $item->location }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="unrestrictedDelta{{ $index }}" class="form-label">Tambah/Kurang Unrestricted</label>
                                            <input type="number" name="unrestricted_delta" id="unrestrictedDelta{{ $index }}" class="form-control" value="0" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="blockedDelta{{ $index }}" class="form-label">Tambah/Kurang Blocked</label>
                                            <input type="number" name="blocked_delta" id="blockedDelta{{ $index }}" class="form-control" value="0" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Data tidak tersedia.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Form Transfer Stok --}}
    <h4 class="mt-5">Pindahkan Stok Antar Lokasi</h4>
    <form action="{{ route('invent.ringkasan.transfer') }}" method="POST" class="row g-3 mt-2">
        @csrf
        <div class="col-md-4">
            <label for="from_location" class="form-label">Dari Lokasi</label>
            <input type="text" name="from_location" id="from_location" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label for="to_location" class="form-label">Ke Lokasi</label>
            <input type="text" name="to_location" id="to_location" class="form-control" required>
        </div>
        <div class="col-md-2">
            <label for="amount" class="form-label">Jumlah</label>
            <input type="number" name="amount" id="amount" class="form-control" min="1" required>
        </div>
        <div class="col-md-2 align-self-end">
            <button type="submit" class="btn btn-warning w-100">Transfer</button>
        </div>
    </form>

</div>
@endsection
