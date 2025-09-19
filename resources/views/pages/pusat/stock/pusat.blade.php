@extends('layouts.app')

@section('title', 'Stock')

@section('main')
<div class="main-content">
    <section class="section">
       <div class="section-header d-flex">
            <h1>Data Stock Pusat</h1>
            <div class="section-header-button ml-auto">
                <a href="{{ route('pusat.stock.create') }}" class="btn btn-primary">Tambah Stock</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-striped table table-bordered">
                                    <tr>
                                        <th>#</th>
                                        <th>Produk</th>
                                        <th>Provider</th>
                                        <th>Kategori</th>
                                        <th>Quantity</th>
                                        <th>Zona</th>
                                        <th>Kuota</th>
                                        <th>Expired</th>
                                        <th>Cost Price</th>
                                        <th>Selling Price</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                    @forelse ($stocks as $stock)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $stock->product->name }}</td>
                                            <td>{{ $stock->product->provider }}</td>
                                            <td>{{ $stock->product->category }}</td>
                                            <td>{{ $stock->quantity }}</td>
                                            <td>{{ $stock->product->zona }}</td>
                                            <td>{{ $stock->product->kuota }}</td>
                                            <td>{{ \Carbon\Carbon::parse($stock->product->expired)->format('d/m/Y') }}</td>
                                            <td>Rp. {{ number_format($stock->product->cost_price, 0, ',', '.') }}</td>
                                            <td>Rp. {{ number_format($stock->product->selling_price, 0, ',', '.') }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('pusat.stock.edit', $stock->id) }}" class="btn btn-sm btn-info btn-icon ml-2">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <a href="{{ route('pusat.stock.distribution.form', $stock->id) }}"
                                                        class="btn btn-sm btn-success btn-icon ml-2">
                                                        <i class="fas fa-share"></i> Send to Cabang
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data tersedia</td>
                                    </tr>
                                    @endforelse
                                </table>
                            </div>
                            <div class="float-right">
                                {{ $stocks->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

