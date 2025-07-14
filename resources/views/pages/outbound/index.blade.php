@extends('layout.main')
@section('title')
Dashboard || Outbound
@endsection
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-center mx-auto mb-0">{{ 'Outbound' }}</h2>
        <div class="actions ml-auto">
            <a href="{{ route('outbound.add') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> {{ 'Add Data' }}
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel Outbound -->
    <div class="table-responsive mx-auto" style="max-width: 1000px;">
        <table class="table table-striped table-hover">
            <thead class="thead-light">
            <tr>
                <th>No.</th>
                <th>{{ 'Shipped Date' }}</th>
                <th>{{ 'No. Document' }}</th>
                <th>{{ 'Shipper' }}</th>
                <th>PLT ID</th>
                <th>{{ 'Location' }}</th>
                <th>{{ 'Material' }}</th>
                <th>{{ 'Material Description' }}</th>
                <th>{{ 'Quantity' }}</th>
                <th>{{ 'UOM' }}</th>
                <th>{{ 'Remarks' }}</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($outbounds as $outbound)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $outbound->shipped_date }}</td>
                    <td>{{ $outbound->no_document }}</td>
                    <td>{{ $outbound->shipper }}</td>
                    <td>{{ $outbound->plt_id }}</td>
                    <td>{{ $outbound->location }}</td>
                    <td>{{ $outbound->material }}</td>
                    <td>{{ $outbound->material_description }}</td>
                    <td>{{ $outbound->inbound_qty }}</td>
                    <td>{{ $outbound->uom }}</td>
                    <td>{{ $outbound->remarks }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection