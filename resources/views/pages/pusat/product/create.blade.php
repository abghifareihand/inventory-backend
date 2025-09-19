@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Produk</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <form action="{{ route('pusat.product.store') }}" method="POST">
                    @csrf
                    <div class="card-body">

                        <!-- Name -->
                        <div class="form-group">
                            <label>Nama Produk</label>
                            <input type="text"
                                name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Provider -->
                        <div class="form-group">
                            <label>Provider</label>
                            <input type="text"
                                name="provider" class="form-control @error('provider') is-invalid @enderror"
                                value="{{ old('provider') }}">
                            @error('provider')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="form-group">
                            <label>Kategori</label>
                            <input type="text"
                                name="category" class="form-control @error('category') is-invalid @enderror"
                                value="{{ old('category') }}">
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Zona -->
                        <div class="form-group">
                            <label>Zona</label>
                            <input type="text"
                                name="zona" class="form-control @error('zona') is-invalid @enderror"
                                value="{{ old('zona') }}">
                            @error('zona')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Kuota -->
                        <div class="form-group">
                            <label>Kuota</label>
                            <input type="text"
                                name="kuota" class="form-control @error('kuota') is-invalid @enderror"
                                value="{{ old('kuota') }}">
                            @error('kuota')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Expired -->
                        <div class="form-group">
                            <label>Expired</label>
                            <input type="date"
                                name="expired" class="form-control @error('expired') is-invalid @enderror"
                                value="{{ old('expired') }}">
                            @error('expired')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text"
                                name="description" class="form-control @error('description') is-invalid @enderror"
                                value="{{ old('description') }}">
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Cost Price -->
                        <div class="form-group">
                            <label>Cost Price</label>
                            <input type="number"
                                name="cost_price" class="form-control @error('cost_price') is-invalid @enderror"
                                value="{{ old('cost_price') }}">
                            @error('cost_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Selling Price -->
                        <div class="form-group">
                            <label>Selling Price</label>
                            <input type="number"
                                name="selling_price" class="form-control @error('selling_price') is-invalid @enderror"
                                value="{{ old('selling_price') }}">
                            @error('selling_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Submit</button>
                        <a href="{{ route('pusat.product.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
