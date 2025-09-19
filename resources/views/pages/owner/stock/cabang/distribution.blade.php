@extends('layouts.app')

@section('title', 'Distribusi ke Sales')

@push('style')
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Distribusi {{ $stock->product->name }} ke Sales</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>

            <div class="card">
                <form action="{{ route('owner.stock.cabang.distribution') }}" method="POST">
                    @csrf
                    <input type="hidden" name="stock_id" value="{{ $stock->id }}">

                    <div class="card-body">

                        <!-- Asal Cabang -->
                        <div class="form-group">
                            <label>Asal Cabang</label>
                            <input type="text" class="form-control" value="{{ $stock->branch->name }}" readonly>
                        </div>

                        <!-- Product Info -->
                        <div class="form-group">
                            <label>Product</label>
                            <input type="text" class="form-control"
                                value="{{ $stock->product->name }} ({{ $stock->product->provider }} | {{ $stock->product->kuota }} | {{ $stock->product->category }} | {{ $stock->product->zona }})"
                                readonly>
                        </div>

                        <!-- Stock Cabang Saat Ini -->
                        <div class="form-group">
                            <label>Stok Cabang Saat Ini</label>
                            <input type="text" class="form-control" value="{{ $stock->quantity }}" readonly>
                        </div>

                        <!-- Sales -->
                        <div class="form-group">
                            <label>Sales</label>
                            <select name="sales_id" class="form-control selectric" required>
                                <option value="">-- Pilih Sales --</option>
                                @foreach($sales as $s)
                                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Quantity -->
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" name="quantity" min="1" max="{{ $stock->quantity }}" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}">
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Notes -->
                        <div class="form-group">
                            <label>Catatan</label>
                            <input type="text" name="notes" class="form-control @error('notes') is-invalid @enderror" value="{{ old('notes') }}">
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Distribusikan</button>
                        <a href="{{ route('owner.stock.cabang.index') }}" class="btn btn-secondary">Batal</a>
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
