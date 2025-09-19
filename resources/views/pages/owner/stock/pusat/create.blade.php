@extends('layouts.app')

@section('title', 'Tambah Stock Pusat')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Stock Pusat</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <form action="{{ route('owner.stock.pusat.store') }}" method="POST">
                    @csrf
                    <div class="card-body">

                      <!-- Produk -->
                        <div class="form-group">
                            <label>Produk</label>
                            <select name="product_id" class="form-control selectric @error('product_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Produk --</option>
                                @foreach($products as $product)
                                    @php
                                        // cek stock pusat saat ini
                                        $currentStock = $product->stocks
                                                        ->where('branch_id', null)
                                                        ->where('sales_id', null)
                                                        ->first();
                                    @endphp
                                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }} ({{ $product->provider }} | {{ $product->kuota }} | {{ $product->category }} | {{ $product->zona }}) (Expired : {{ \Carbon\Carbon::parse($product->expired)->format('d/m/Y') }})
                                        @php
                                            $currentStock = $product->stocks
                                                            ->where('branch_id', null)
                                                            ->where('sales_id', null)
                                                            ->first();
                                        @endphp
                                        @if($currentStock)
                                            (Stok : {{ $currentStock->quantity }})
                                        @endif
                                    </option>
                                                                    @endforeach
                            </select>
                            @error('product_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>



                        <!-- Quantity -->
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}" min="1" required>
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Submit</button>
                        <a href="{{ route('owner.stock.pusat.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
@endpush
