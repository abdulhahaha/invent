@extends('layout.main')

@section('title')
Dashboard || Inventory
@endsection

@section('content')
<div class="container">
    <h2 class="mb-4">Detail Inventory</h2>

    {{-- TABEL INVENTORY --}}
    <table class="table table-striped table-bordered">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Date</th>
                <th>Location</th>
                <th>PLT ID</th>
                <th>Material</th>
                <th>Material Description</th>
                <th>UOM</th>
                <th>Unrestricted</th>
                <th>Blocked</th>
                <th>Remarks</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($inventory as $inventoryDetail)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $inventoryDetail->receive_date }}</td>
                <td>{{ $inventoryDetail->location }}</td>
                <td>{{ $inventoryDetail->plt_id }}</td>
                <td>{{ $inventoryDetail->material }}</td>
                <td>{{ $inventoryDetail->material_description }}</td>
                <td>{{ $inventoryDetail->uom }}</td>
                <td>{{ $inventoryDetail->unrestricted }}</td>
                <td>{{ $inventoryDetail->blocked }}</td>
                <td>{{ $inventoryDetail->remarks }}</td>
                <td>
                    {{-- Tombol Edit --}}
                    <a href="{{ route('invent.edit', $inventoryDetail->id) }}" class="btn btn-warning btn-sm">Edit</a>


                    {{-- Tombol Delete --}}
                    <form action="{{ route('invent.destroy', $inventoryDetail->id) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Are you sure you want to delete this item?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="11" class="text-center">Tidak ada data inventory.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
