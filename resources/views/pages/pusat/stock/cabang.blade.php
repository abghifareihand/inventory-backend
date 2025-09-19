@extends('layouts.app')

@section('title', 'Stock Cabang')

@section('main')
<div class="main-content">
    <section class="section">
       <div class="section-header d-flex">
            <h1>Data Stock Cabang</h1>
       </div>
       <div class="section-body">
           <div class="row mt-4">
               <div class="col-12">
                   <div class="card">
                       <div class="card-body">
                           <div class="table-responsive">
                               <table class="table-striped table table-bordered">
                                   <tr>
                                       <th>#</th>
                                       <th>Produk</th>
                                       <th>Cabang</th>
                                       <th>Provider</th>
                                       <th>Kategori</th>
                                       <th>Quantity</th>
                                       <th>Zona</th>
                                       <th>Kuota</th>
                                       <th>Expired</th>
                                       <th>Cost Price</th>
                                       <th>Selling Price</th>
                                   </tr>
                                   @forelse ($stocks as $stock)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $stock->product->name }}</td>
                                            <td>{{ $stock->branch->name ?? '-' }}</td>
                                            <td>{{ $stock->product->provider }}</td>
                                            <td>{{ $stock->product->category }}</td>
                                            <td>{{ $stock->quantity }}</td>
                                            <td>{{ $stock->product->zona }}</td>
                                            <td>{{ $stock->product->kuota }}</td>
                                            <td>{{ \Carbon\Carbon::parse($stock->product->expired)->format('d/m/Y') }}</td>
                                            <td>Rp. {{ number_format($stock->product->cost_price, 0, ',', '.') }}</td>
                                            <td>Rp. {{ number_format($stock->product->selling_price, 0, ',', '.') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="12" class="text-center">Tidak ada data tersedia</td>
                                        </tr>
                                    @endforelse
                               </table>
                               <div class="float-right">
                                   {{ $stocks->withQueryString()->links() }}
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
    </section>
</div>
@endsection
