@extends('layout.main')

@section('title', 'Manajemen Inventory')

@section('content')
<div class="container">
    <h2 class="mb-4">Manajemen Inventory</h2>

    <a href="{{ route('invent.add') }}" class="btn btn-primary mb-3">Tambah Barang</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Material</th>
                <th>Deskripsi</th>
                <th>Lokasi</th>
                <th>Satuan (UOM)</th>
                <th>Unrestricted</th>
                <th>Blocked</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inventory as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->material }}</td>
                <td>{{ $item->material_description }}</td>
                <td>{{ $item->location }}</td>
                <td>{{ $item->uom }}</td>
                <td>{{ $item->unrestricted }}</td>
                <td>{{ $item->blocked }}</td>
                <td>
                    <a href="{{ route('inventory.detail.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('inventory.detail.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('inventory.detail.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
