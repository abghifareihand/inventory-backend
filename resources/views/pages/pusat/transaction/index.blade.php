@extends('layouts.app')

@section('title', 'Data Transaksi Sales (Pusat)')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex">
            <h1>Data Pengajuan Harga</h1>
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
                                            <th>Cabang</th>
                                            <th>Outlet</th>
                                            <th>Total Asli</th>
                                            <th>Pengajuan</th>
                                            <th>Profit</th>
                                            <th>Status</th>
                                            <th style="text-align: center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($transactions as $transaction)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                                            <td>{{ $transaction->sales->name }}</td>
                                            <td>{{ $transaction->branch->name ?? '-' }}</td>
                                            <td>{{ $transaction->outlet->name ?? '-' }}</td>
                                            <td>Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>

                                            {{-- Ambil pengajuan terakhir jika ada --}}
                                            @php
                                                $edit = $transaction->edits->last();
                                            @endphp

                                            <td>
                                                @if($edit)
                                                    Rp {{ number_format($edit->edit_total, 0, ',', '.') }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            {{-- Estimasi Profit --}}
                                            <td>
                                                @if($edit)
                                                    Rp {{ number_format($edit->edit_profit, 0, ',', '.') }}
                                                @else
                                                    -
                                                @endif
                                            </td>

                                            {{-- <td>
                                                {{ $edit->edit_reason ?? '-' }}
                                            </td> --}}
                                            <td>
                                                @if($edit)
                                                    <span class="badge badge-{{ $edit->status == 'pending' ? 'warning' : ($edit->status == 'approved' ? 'success' : 'danger') }}">
                                                        {{ ucfirst($edit->status) }}
                                                    </span>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="" class="btn btn-sm btn-secondary btn-icon">
                                                    <i class="fas fa-eye"></i> Detail
                                                </a>
                                                @if($edit && $edit->status == 'pending')
                                                    <form action="{{ route('pusat.transaction.approve', $edit->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        <button class="btn btn-sm btn-success btn-icon" onclick="return confirm('Setujui pengajuan ini?')">
                                                            <i class="fas fa-check"></i> Approve
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('pusat.transaction.reject', $edit->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        <button class="btn btn-sm btn-danger btn-icon" onclick="return confirm('Tolak pengajuan ini?')">
                                                            <i class="fas fa-times"></i> Reject
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="10" class="text-center">Tidak ada transaksi tersedia</td>
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
