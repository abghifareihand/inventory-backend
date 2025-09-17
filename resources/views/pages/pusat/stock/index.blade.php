@extends('layouts.app')

@section('title', 'Stock')


@section('main')
<div class="main-content">
    <section class="section">
       <div class="section-header d-flex">
            <h1>Data Stock Pusat</h1>
            <div class="section-header-button ml-auto">
                <a href="" class="btn btn-primary">Tambah Stock</a>
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
                            <div class="clearfix mb-3"></div>
                            <div class="table-responsive">
                                <table class="table-striped table">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Cost Price</th>
                                        <th>Selling Price</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                    @forelse ($stocks as $stock)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $stock->product->name }}</td>
                                            <td>{{ $stock->quantity }}</td>
                                            <td>Rp. {{ number_format($stock->product->cost_price, 0, ',', '.') }}</td>
                                            <td>Rp. {{ number_format($stock->product->selling_price, 0, ',', '.') }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href="" class="btn btn-sm btn-info btn-icon">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <form action="" method="POST" class="ml-2">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                            <i class="fas fa-times"></i> Delete
                                                        </button>
                                                    </form>
                                                    <a href="{{ route('pusat.stock.distribution.form', $stock->id) }}"
                                                        class="btn btn-sm btn-success btn-icon ml-2">
                                                        <i class="fas fa-share"></i> Send
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

{{-- <!-- Modal Distribusi Stok -->
<div class="modal fade" id="distribusiModal" tabindex="-1" role="dialog" aria-labelledby="distribusiModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{ route('pusat.stock.distribution') }}">
            @csrf
            <input type="hidden" name="stock_id" id="modal-stock-id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="distribusiModalLabel">Distribusi Stok</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Produk</label>
                        <input type="text" class="form-control" id="modal-product-name" readonly>
                    </div>

                    <!-- Catatan -->
                    <div class="form-group">
                        <label>Catatan</label>
                        <textarea name="notes" class="form-control" placeholder="Isi catatan (opsional)"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Cabang</label>
                        <select name="branch_id" class="form-control" required>
                            <option value="">-- Pilih Cabang --</option>
                            @foreach(\App\Models\Branch::all() as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" name="quantity" class="form-control" min="1" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Distribusi</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div> --}}
@endsection

{{-- @push('scripts')
<script>
    $('#distribusiModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // tombol yang klik modal
        var stockId = button.data('stock-id');
        var productName = button.data('product-name');

        var modal = $(this);
        modal.find('#modal-stock-id').val(stockId);
        modal.find('#modal-product-name').val(productName);
    });
</script>
@endpush --}}

