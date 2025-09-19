@extends('layouts.app')

@section('title', 'Edit Stock Pusat')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Stock Pusat</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <form action="{{ route('pusat.stock.update', $stock->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">

                        <!-- Produk (readonly) -->
                        <div class="form-group">
                            <label>Produk</label>
                            <input type="text" class="form-control" value="{{ $stock->product->name }}" disabled>
                            <small class="text-muted">Produk tidak bisa diubah karena stock sudah terdaftar</small>
                        </div>

                        <!-- Quantity -->
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror"
                                   value="{{ old('quantity', $stock->quantity) }}" min="0" required>
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Update</button>
                        <a href="{{ route('pusat.stock.pusat') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
@endpush
