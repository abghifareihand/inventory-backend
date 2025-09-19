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
                                <table class="table-striped table table-bordered">
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
                                                <!-- Tombol Ajukan -->
                                                @php
                                                    $hasEdit = $transaction->edits->isNotEmpty();
                                                @endphp

                                                @if (! $hasEdit)
                                                    <!-- Tombol Ajukan hanya muncul jika belum ada pengajuan -->
                                                    <button class="btn btn-sm btn-info btn-icon ml-2" data-toggle="modal" data-target="#editModal-{{ $transaction->id }}">
                                                        <i class="fas fa-edit"></i> Ajukan
                                                    </button>
                                                @endif
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
                            {{-- Modal harus di luar table-responsive --}}

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
    @foreach ($transactions as $transaction)
        <div class="modal fade" id="editModal-{{ $transaction->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <form action="{{ route('cabang.transaction.edit-request', $transaction->id) }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">Ajukan Perubahan Total</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                    <div class="form-group">
                        <label>Total Baru</label>
                        <input type="number" name="edit_total" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Alasan</label>
                        <textarea name="edit_reason" class="form-control" required></textarea>
                    </div>
                    </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Ajukan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    @endforeach
@endsection
