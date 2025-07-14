@extends('layout.main')

@section('title', 'Edit Inventory')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Inventory</h2>

    {{-- Alert error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Gunakan ID asli dari database --}}
    <form action="{{ route('invent.update', $inventory->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Data hanya ditampilkan (readonly) --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Tanggal Terima</label>
                <input type="text" class="form-control" value="{{ $inventory->receive_date }}" disabled>
            </div>
            <div class="col-md-6 mb-3">
                <label>Lokasi</label>
                <input type="text" class="form-control" value="{{ $inventory->location }}" disabled>
            </div>
            <div class="col-md-6 mb-3">
                <label>PLT ID</label>
                <input type="text" class="form-control" value="{{ $inventory->plt_id }}" disabled>
            </div>
            <div class="col-md-6 mb-3">
                <label>Material</label>
                <input type="text" class="form-control" value="{{ $inventory->material }}" disabled>
            </div>
            <div class="col-md-6 mb-3">
                <label>Deskripsi Material</label>
                <input type="text" class="form-control" value="{{ $inventory->material_description }}" disabled>
            </div>
            <div class="col-md-6 mb-3">
                <label>UOM</label>
                <input type="text" class="form-control" value="{{ $inventory->uom }}" disabled>
            </div>
        </div>

        {{-- Data yang bisa diedit --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="unrestricted">Unrestricted</label>
                <input type="number" name="unrestricted" id="unrestricted" class="form-control"
                       value="{{ old('unrestricted', $inventory->unrestricted) }}" min="0" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="blocked">Blocked</label>
                <input type="number" name="blocked" id="blocked" class="form-control"
                       value="{{ old('blocked', $inventory->blocked) }}" min="0" required>
            </div>
            <div class="col-12 mb-3">
                <label for="remarks">Catatan</label>
                <textarea name="remarks" id="remarks" class="form-control" rows="3">{{ old('remarks', $inventory->remarks) }}</textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('invent.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
