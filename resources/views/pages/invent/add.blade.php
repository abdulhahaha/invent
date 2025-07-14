@extends('layout.main')

@section('title', 'Lengkapi Data Inventory')

@section('content')
<div class="container">
    <h2 class="mb-4">Lengkapi Data Inventory</h2>

    {{-- Notifikasi Error Validasi --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Alert jika data inbound tidak ada --}}
    @if(!isset($inbound) || !$inbound)
        <div class="alert alert-warning">
            Data inbound tidak tersedia. Pastikan Anda memilih dari daftar inbound.
        </div>
    @endif

    {{-- Form Input Inventory --}}
    <form action="{{ route('invent.store') }}" method="POST">
        @csrf

        {{-- Data dari Inbound (readonly) --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Terima</label>
                <input type="text" class="form-control" value="{{ optional($inbound)->receive_date ?? '-' }}" disabled>
                <input type="hidden" name="receive_date" value="{{ optional($inbound)->receive_date }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Lokasi</label>
                <input type="text" class="form-control" value="{{ optional($inbound)->location ?? '-' }}" disabled>
                <input type="hidden" name="location" value="{{ optional($inbound)->location }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">PLT ID</label>
                <input type="text" class="form-control" value="{{ optional($inbound)->plt_id ?? '-' }}" disabled>
                <input type="hidden" name="plt_id" value="{{ optional($inbound)->plt_id }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Material</label>
                <input type="text" class="form-control" value="{{ optional($inbound)->material ?? '-' }}" disabled>
                <input type="hidden" name="material" value="{{ optional($inbound)->material }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Deskripsi Material</label>
                <input type="text" class="form-control" value="{{ optional($inbound)->material_description ?? '-' }}" disabled>
                <input type="hidden" name="material_description" value="{{ optional($inbound)->material_description }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">UOM</label>
                <input type="text" class="form-control" value="{{ optional($inbound)->uom ?? '-' }}" disabled>
                <input type="hidden" name="uom" value="{{ optional($inbound)->uom }}">
            </div>
        </div>

        {{-- Input Manual --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="unrestricted" class="form-label">Unrestricted</label>
                <input type="number" name="unrestricted" id="unrestricted" class="form-control"
                       value="{{ old('unrestricted') }}" min="0" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="blocked" class="form-label">Blocked</label>
                <input type="number" name="blocked" id="blocked" class="form-control"
                       value="{{ old('blocked') }}" min="0" required>
            </div>
            <div class="col-12 mb-4">
                <label for="remarks" class="form-label">Catatan</label>
                <textarea name="remarks" id="remarks" class="form-control" rows="3">{{ old('remarks') }}</textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('inbound.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
