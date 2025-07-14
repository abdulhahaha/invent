@extends('layout.main')

@section('title')
    Dashboard || Inbound
@endsection

@section('content')
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Inbound</h2>
        <a href="{{ route('inbound.add') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-1"></i> Add Data
        </a>
    </div>

    <!-- Data Table -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>No.</th>
                    <th>Date</th>
                    <th>Document No.</th>
                    <th>Consignee</th>
                    <th>Material</th>
                    <th>Material Description</th>
                    <th>Quantity</th>
                    <th>UOM</th>
                    <th>PLT ID</th>
                    <th>Location</th>
                    <th>Actions</th>
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
                        <td>
                            <a href="{{ route('inbound.edit', $inbound->id) }}" class="btn btn-sm btn-warning mb-1">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('inbound.destroy', $inbound->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this item?');">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-muted">No inbound data found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
