@extends('layout.main')
@section('title')
Edit || Inbound
@endsection
@section('content')
<div class="container">
    <h2 class="text-center mb-4">{{ 'Edit Data' }}</h2>
    
    <form action="{{ route('inbound.update', $inbound->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="receive_date">{{ 'Receive Date' }}</label>
            <input type="date" name="receive_date" id="receive_date" class="form-control" value="{{ old('receive_date', $inbound->receive_date) }}" required>
        </div>

        <div class="form-group">
            <label for="no_document">{{ 'No. Document' }}</label>
            <input type="text" name="no_document" id="no_document" class="form-control" value="{{ old('no_document', $inbound->no_document) }}" required>
        </div>

        <div class="form-group">
            <label for="consignee">{{ 'Consignee' }}</label>
            <input type="text" name="consignee" id="consignee" class="form-control" value="{{ old('consignee', $inbound->consignee) }}" required>
        </div>

        <div class="form-group">
            <label for="material">{{ 'Material' }}</label>
            <input type="text" name="material" id="material" class="form-control" value="{{ old('material', $inbound->material) }}" required>
        </div>

        <div class="form-group">
            <label for="material_description">{{ 'Material Description' }}</label>
            <input type="text" name="material_description" id="material_description" class="form-control" value="{{ old('material_description', $inbound->material_description) }}" required>
        </div>

        <div class="form-group">
            <label for="inbound_qty">{{ 'Inbound Quantity' }}</label>
            <input type="number" name="inbound_qty" id="inbound_qty" class="form-control" value="{{ old('inbound_qty', $inbound->inbound_qty) }}" required>
        </div>

        <div class="form-group">
            <label for="uom">{{ 'UOM (Unit of Measure)' }}</label>
            <input type="text" name="uom" id="uom" class="form-control" value="{{ old('uom', $inbound->uom) }}" required>
        </div>

        <div class="form-group">
            <label for="plt_id">PLT ID</label>
            <input type="text" name="plt_id" id="plt_id" class="form-control" value="{{ old('plt_id', $inbound->plt_id) }}" required>
        </div>

        <div class="form-group">
            <label for="location">{{ 'Location' }}</label>
            <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $inbound->location) }}" required>
        </div>

        <button type="submit" class="btn btn-success">{{ 'Update' }}</button>
        <a href="{{ route('inbound.index') }}" class="btn btn-secondary">{{ 'Cancel' }}</a>
    </form>
</div>
@endsection