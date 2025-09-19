@extends('layouts.app')

@section('title', 'Data Transaksi Sales')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex">
            <h1>Data Transaksi Sales</h1>
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
                                <table class="table-striped table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tanggal</th>
                                            <th>Sales</th>
                                            <th>Outlet</th>
                                            <th>Total</th>
                                            <th>Profit</th> {{-- kolom profit --}}
                                            <th style="text-align: center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($transactions as $transaction)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                                            <td>{{ $transaction->sales->name }}</td>
                                            <td>{{ $transaction->outlet->name ?? '-' }}</td>
                                            <td>Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                                            <td>Rp {{ number_format($transaction->profit, 0, ',', '.') }}</td> {{-- tampilkan profit --}}
                                            <td class="text-center">
                                                <a href="{{ route('cabang.transaction.show', $transaction->id) }}" class="btn btn-sm btn-secondary btn-icon">
                                                    <i class="fas fa-eye"></i> Detail
                                                </a>
                                                <a href="" class="btn btn-sm btn-info btn-icon ml-2">
                                                    <i class="fas fa-edit"></i> Ajukan
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada transaksi tersedia</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="float-right mt-2">
                                {{ $transactions->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection
