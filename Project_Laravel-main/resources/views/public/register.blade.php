@extends('layouts.app')

@section('title', 'Registrasi - Web Perpustakaan')

@section('icon', 'img/book_1.png')

@section('header')
    <style>
        body {
            background: linear-gradient(to right, #a9e4f1, #ffffff);
            opacity: 1;
        }
    </style>
@endsection

@section('main')
    <section class="login-container">
        <div class="card shadow-lg">
            <div class="card-header">
                <img src="{{ asset('img/logo.svg') }}" alt="img-logo" class="img-logo" loading="lazy" />
            </div>
            <div class="card-body">
                <form class="row g-3 needs-validation" action="{{ route('user.register') }}" method="post">
                    @csrf
                    <div class="form-label col-md-6">
                        <label for="username" class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person-fill"></i>
                            </span>
                            <input type="text" name="username" id="username" value="{{ old('username') }}"
                                class="form-control" placeholder="Masukkan username Anda" required />
                        </div>
                        @error('username')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-label col-md-6">
                        <label for="alamat" class="form-label">Alamat</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-geo-alt-fill"></i>
                            </span>
                            <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}"
                                class="form-control" placeholder="Masukkan alamat Anda" required />
                        </div>
                        @error('alamat')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-label col-md-6">
                        <label for="email" class="form-label">E-mail</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-envelope-fill"></i>
                            </span>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                class="form-control" placeholder="Masukkan email Anda" required />
                        </div>
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-label col-md-6">
                        <label for="notelp" class="form-label">No. Telp</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-telephone-fill"></i>
                            </span>
                            <input type="tel" name="notelp" id="notelp" value="{{ old('notelp') }}"
                                class="form-control" placeholder="Masukkan nomor telepon Anda" required />
                        </div>
                        @error('notelp')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-label col-md-6 my-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-key-fill"></i>
                            </span>
                            <input type="password" name="password" id="password" value="{{ old('password') }}"
                                class="form-control" placeholder="Masukkan password Anda" required />
                        </div>
                        @error('password')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-label col-md-6 my-3">
                        <label for="password" class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-key-fill"></i>
                            </span>
                            <input type="password" name="valid_password" id="valid_password"
                                value="{{ old('valid_password') }}"class="form-control"
                                placeholder="Konfirmasi password Anda" required />
                        </div>
                        @error('valid_password')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-primary" type="submit" style="background-color: #06c3ee; color: white">Register</button>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <a href="{{ route('login') }}" class="link-underline link-underline-opacity-0">
                    <p class="text-center" style="color: #06c3ee;">
                        Sudah punya akun? Silahkan masuk
                    </p>
                </a>
            </div>
        </div>
    </section>
@endsection
