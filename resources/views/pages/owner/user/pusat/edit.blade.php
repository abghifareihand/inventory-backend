@extends('layouts.app')

@section('title', 'Edit Akun Pusat')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Akun Pusat</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <form action="{{ route('owner.user.pusat.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">

                        <!-- Name -->
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text"
                                name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $user->name) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Username -->
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text"
                                name="username" class="form-control @error('username') is-invalid @enderror"
                                value="{{ old('username', $user->username) }}">
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <label>Password <small class="text-muted">(kosongkan jika tidak diubah)</small></label>
                            <div class="input-group">
                                <input type="password"
                                    name="password" id="password" class="form-control @error('password') is-invalid @enderror"
                                    value="">
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

                    </div>

                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Update</button>
                        <a href="{{ route('owner.user.pusat.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
