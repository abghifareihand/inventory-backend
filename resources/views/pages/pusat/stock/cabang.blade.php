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
                               <table class="table-striped table">
                                   <tr>
                                       <th>#</th>
                                       <th>Cabang</th>
                                       <th>Produk</th>
                                       <th>Quantity</th>
                                       <th>Cost Price</th>
                                       <th>Selling Price</th>
                                   </tr>
                                   @forelse ($branches as $branch)
                                       @foreach ($branch->stocks as $stock)
                                       <tr>
                                           <td>{{ $loop->parent->iteration }}.{{ $loop->iteration }}</td>
                                           <td>{{ $branch->name }}</td>
                                           <td>{{ $stock->product->name }}</td>
                                           <td>{{ $stock->quantity }}</td>
                                           <td>Rp. {{ number_format($stock->product->cost_price, 0, ',', '.') }}</td>
                                           <td>Rp. {{ number_format($stock->product->selling_price, 0, ',', '.') }}</td>
                                       </tr>
                                       @endforeach
                                   @empty
                                       <tr>
                                           <td colspan="6" class="text-center">Tidak ada data tersedia</td>
                                       </tr>
                                   @endforelse
                               </table>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
    </section>
</div>
@endsection
