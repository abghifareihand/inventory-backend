@extends('layouts.app')

@section('title', 'Edit Cabang')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Cabang</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <form action="{{ route('owner.branch.update', $branch->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">

                        <!-- Name -->
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text"
                                name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $branch->name) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text"
                            name="address" class="form-control @error('address') is-invalid @enderror"
                            value="{{ old('address', $branch->address) }}">
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Update</button>
                        <a href="{{ route('owner.branch.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>

        </div>
    </section>
</div>
@endsection
