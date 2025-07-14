@extends('layout.main')

@section('title', 'Kelola Jumlah Barang Keluar')

@section('content')
<div class="container">
    <h2 class="mb-4">Kelola Jumlah Barang Keluar</h2>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Tanggal Keluar</th>
                <th>Material</th>
                <th>Deskripsi</th>
                <th>Lokasi</th>
                <th>Jumlah Saat Ini</th>
                <th>Update Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($outbounds as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ \Carbon\Carbon::parse($item->shipped_date)->format('d M Y') }}</td>
                <td>{{ $item->material }}</td>
                <td>{{ $item->material_description }}</td>
                <td>{{ $item->location }}</td>
                <td>{{ $item->inbound_qty }}</td>
                <td>
                    <form action="{{ route('outbound.updateQty', $item->id) }}" method="POST" class="d-flex">
                        @csrf
                        @method('PUT')
                        <input type="number" name="inbound_qty" value="{{ $item->inbound_qty }}" class="form-control me-2" required>
                        <button class="btn btn-success btn-sm">Simpan</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
