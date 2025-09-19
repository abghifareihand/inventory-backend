@extends('layouts.app')

@section('title', 'Data Produk')

@section('main')
<div class="main-content">
    <section class="section">
       <div class="section-header d-flex">
            <h1>Data Produk</h1>
            <div class="section-header-button ml-auto">
                <a href="{{ route('pusat.product.create') }}" class="btn btn-primary">Tambah Produk</a>
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
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Provider</th>
                                            <th>Kategori</th>
                                            <th>Zona</th>
                                            <th>Kuota</th>
                                            <th>Expired</th>
                                            <th>Cost Price</th>
                                            <th>Selling Price</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($products as $product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->provider }}</td>
                                            <td>{{ $product->category }}</td>
                                            <td>{{ $product->zona }}</td>
                                            <td>{{ $product->kuota }}</td>
                                            <td>{{ \Carbon\Carbon::parse($product->expired)->format('d/m/Y') }}</td>
                                            <td>Rp {{ number_format($product->cost_price, 0, ',', '.') }}</td>
                                            <td>Rp {{ number_format($product->selling_price, 0, ',', '.') }}</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('pusat.product.edit', $product->id) }}" class="btn btn-sm btn-info btn-icon ml-2">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <form action="{{ route('pusat.product.destroy', $product->id) }}" method="POST" class="ml-2">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                            <i class="fas fa-times"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center">Tidak ada data tersedia</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="float-right mt-2">
                                {{ $products->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
