@extends('layouts.app')

@section('title', 'Tambah Akun Sales')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Akun Sales</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <form action="{{ route('cabang.user.store') }}" method="POST">
                    @csrf
                    <div class="card-body">

                        <!-- Name -->
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text"
                                name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Username -->
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text"
                                name="username" class="form-control @error('username') is-invalid @enderror"
                                value="{{ old('username') }}">
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <label>Password</label>
                            <div class="input-group">
                                <input type="password"
                                    name="password" id="password" class="form-control @error('password') is-invalid @enderror"
                                    value="{{ old('password') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password','toggleIcon')">
                                        <i class="fas fa-eye" id="toggleIcon"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Cabang otomatis -->
                        <div class="form-group">
                            <label>Cabang</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->branch->name }}" disabled>
                            <small class="text-muted">Cabang ini otomatis terhubung dengan akun sales</small>
                        </div>

                    </div>

                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Submit</button>
                        <a href="{{ route('cabang.user.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
