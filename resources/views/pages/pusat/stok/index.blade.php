@extends('layouts.app')

@section('title', 'Users')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Users</h1>
                <div class="section-header-button">
                    <a href="" class="btn btn-primary">Add New</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Users</a></div>
                    <div class="breadcrumb-item">All Users</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <h2 class="section-title">Users</h2>
                <p class="section-lead">
                    You can manage all Users, such as editing, deleting and more.
                </p>


                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Posts</h4>
                            </div>
                            <div class="card-body">

                                <div class="float-right">
                                    <form method="GET" action="{{ route('pusat.stok.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="keyword">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>

                                            <th>Name</th>
                                            <th>Desc</th>
                                            <th>Quantity</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($stocks as $stock)
                                            <tr>

                                                <td>{{ $stock->product->name }}
                                                </td>
                                                <td>
                                                    {{ $stock->product->description }}
                                                </td>
                                                <td>
                                                    {{ $stock->quantity }}
                                                </td>
                                                <td>
                                                    {{ $stock->created_at->format('d M Y') }}
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href=''
                                                            class="btn btn-sm btn-info btn-icon">
                                                            <i class="fas fa-edit"></i>
                                                            Edit
                                                        </a>

                                                        <form action=""
                                                            method="POST" class="ml-2">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}" />
                                                            <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                <i class="fas fa-times"></i> Delete
                                                            </button>
                                                        </form>

                                                                                                                <!-- Distribusi stok -->
                                                        <a href="#" class="btn btn-sm btn-success btn-icon ml-2"
                                                           data-toggle="modal"
                                                           data-target="#distribusiModal"
                                                           data-stock-id="{{ $stock->id }}"
                                                           data-product-name="{{ $stock->product->name }}">
                                                            <i class="fas fa-share"></i> Distribusi
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach


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
<!-- Modal Distribusi Stok -->
<div class="modal fade" id="distribusiModal" tabindex="-1" role="dialog" aria-labelledby="distribusiModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{ route('pusat.stok.distribusi') }}">
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
</div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>

   <script>
    $('#distribusiModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // tombol yang diklik
        var stockId = button.data('stock-id'); // ambil stock id
        var productName = button.data('product-name'); // ambil product name

        var modal = $(this);
        modal.find('#modal-stock-id').val(stockId); // input hidden
        modal.find('#modal-product-name').val(productName); // input readonly
    });
</script>
@endpush
