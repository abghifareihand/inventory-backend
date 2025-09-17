@extends('layouts.auth')

@section('title', 'Login')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">
@endpush

@section('main')
<div class="card card-primary">
    <div class="card-header">
        <h4>Login</h4>
    </div>

    <div class="card-body">

            {{-- Notifikasi Error --}}
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            {{-- Notifikasi Sukses --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif


        <form method="POST"
              action="{{ route('login.post') }}"
              class="needs-validation"
              novalidate="">
            @csrf

            <div class="form-group">
                <label for="username">Username</label>
                <input id="username"
                       type="text"
                       class="form-control"
                       name="username"
                       tabindex="1"
                       required
                       autofocus>
                <div class="invalid-feedback">
                    Masukkan username anda
                </div>
            </div>

            <div class="form-group">
                <div class="d-block">
                    <label for="password" class="control-label">Password</label>
                </div>
                <input id="password"
                       type="password"
                       class="form-control"
                       name="password"
                       tabindex="2"
                       required>
                <div class="invalid-feedback">
                    Masukkan password anda
                </div>
            </div>

            <div class="form-group">
                <button type="submit"
                        class="btn btn-primary btn-lg btn-block"
                        tabindex="4">
                    Login
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
    <!-- JS Libraries -->

    <!-- Page Specific JS File -->
@endpush
