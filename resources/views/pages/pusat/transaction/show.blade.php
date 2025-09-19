@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Transaksi</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('cabang.transaction.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
            </div>
        </div>

        <div class="section-body">

            <!-- Informasi Sales -->
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table-striped table">
                                <tr>
                                    <th>Nama Sales</th>
                                    <td>{{ $transaction->sales->name }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Owner</th>
                                    <td>{{ $transaction->outlet->name }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Outlet</th>
                                    <td>{{ $transaction->outlet->name_outlet }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat Outlet</th>
                                    <td>{{ $transaction->outlet->address_outlet }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal</th>
                                    <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Total Penjualan</th>
                                    <td>Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Items -->
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                             <h5>Detail Produk</h5>
                            <div class="table-responsive">
                                <table class="table-striped table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Produk</th>
                                            <th>Qty</th>
                                            <th>Harga Asli</th>
                                            <th>Harga Jual</th>
                                            <th>Margin</th>
                                            <th>Subtotal</th>
                                            <th>Profit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalProfit = 0;
                                        @endphp
                                        @foreach($transaction->items as $item)
                                        @php
                                            $profit = ($item->price - $item->cost_price) * $item->quantity;
                                            $totalProfit += $profit;
                                            $margin = $item->price - $item->cost_price;
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->product->name }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>Rp {{ number_format($item->cost_price,0,',','.') }}</td>
                                            <td>Rp {{ number_format($item->price,0,',','.') }}</td>
                                            <td>Rp {{ number_format($margin,0,',','.') }}</td>
                                            <td>Rp {{ number_format($item->price * $item->quantity,0,',','.') }}</td>
                                            <td>Rp {{ number_format($profit,0,',','.') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="7" class="text-right">Total Profit</th>
                                            <th>Rp {{ number_format($totalProfit,0,',','.') }}</th>
                                        </tr>
                                    </tfoot>
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
