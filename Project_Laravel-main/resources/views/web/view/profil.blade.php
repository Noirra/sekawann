@extends('layouts.app')

@auth
    @php
        $userRole = Auth::user()->user_level;
        $user = Auth::user();
    @endphp
@endauth

@section('title', 'Data Profil')

@section('header')
    <style>
        body {
            background-color: whitesmoke !important;moke;
            width: 100vw;
            height: 100vh;
        }

        ::-webkit-scrollbar {
            width: 0px;
        }
    </style>
@endsection

@section('main')
    @include('layouts.nav')
    <div class="container-flex text-center pt-3 pb-3" style="background: whitesmoke">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (session('updated'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ session('updated') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (session('deleted'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ session('deleted') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="text-bg-dark p-2">
            @if ($user->user_profil_url === '' || $user->user_profil_url === null)
                <img width="150px" height="150px" src="{{ asset('img/user.png') }}"
                    class="rounded m-2 mx-auto d-block shadow-md" alt="...">
            @else
                <img width="150px" height="150px"
                    src="{{ asset('storage/user/profile/' . basename($user->user_profil_url)) }}"
                    class="rounded m-2 mx-auto d-block shadow-md" alt="...">
            @endif
            <h3 class="text-white">{{ $user->user_fullname }} - {{ $user->user_username }}</h3>
            <h5 class="text-white">{{ $user->user_alamat }} | {{ $user->user_notelp }}</h5>
            <p class="text-white">{{ $user->user_email }}</p>
            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#updateUserModal">
                Update Profil
            </button>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#logoutModal">
                Log out
            </button>
        </div>
    </div>
    <div class="container-flex text-center p-4">
        <h5 class="text-light">Metode Pembayaran</h5>
    </div>
    <div class="container d-flex flex-wrap justify-content-evenly">
        @if ($user->user_id)
            @php
                $paymentMethods = [
                    'dana' => 'dana.png',
                    'ovo' => 'ovo.png',
                    'bca' => 'bca.png',
                    'cod' => 'cod.png',
                ];
            @endphp

            @foreach ($paymentMethods as $method => $imageName)
                @php
                    $hasPaymentMethod = false;
                    $currentPaymentMethod = null;
                    foreach ($metode_pembayaran as $item) {
                        if ($item->metode_pembayaran_jenis === $method) {
                            $hasPaymentMethod = true;
                            $currentPaymentMethod = $item;
                            break;
                        }
                    }
                    $modalId = $hasPaymentMethod ? 'editMetode' . $method : 'addMetode' . ucfirst($method);
                    $namaValue = $hasPaymentMethod ? $currentPaymentMethod->metode_pembayaran_nama : '';
                    $nomorValue = $hasPaymentMethod ? $currentPaymentMethod->metode_pembayaran_nomor : '';
                    $formAction = $hasPaymentMethod ? route('metode_pembayaran.update', ['metode_pembayaran_id' => $currentPaymentMethod->metode_pembayaran_id]) : route('action.create_metode_pembayaran');
                @endphp

                <label style="width: 200px" class="card text-bg-light p-2">
                    <img height="50px" src="{{ asset('img/' . $imageName) }}" class="mx-auto d-block" alt="...">
                    <button style="background: #06c3ee" class="m-2 btn btn-{{ $hasPaymentMethod ? 'warning' : 'primary' }}" type="button"
                        data-bs-toggle="modal" data-bs-target="#{{ $modalId }}" name="metode_pembayaran">
                        {{ $hasPaymentMethod ? 'Ubah Metode Pembayaran' : 'Tambahkan Metode' }}
                    </button>
                </label>

                <div class="modal fade" data-bs-backdrop="static" id="{{ $modalId }}" tabindex="-1"
                    aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="background: #06c3ee">
                                <h1 class="modal-title fs-5" id="{{ $modalId }}Label">
                                    Metode Pembayaran</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ $formAction }}" method="post">
                                <div class="modal-body">
                                    @csrf
                                    @if ($hasPaymentMethod)
                                        @method('PATCH')
                                    @endif
                                    <div class="m-2">
                                        <label for="nama" class="form-label">Nama Pemilik</label>
                                        <input type="text" name="nama" class="form-control" id="nama"
                                            placeholder="Masukkan Nama Metode" value="{{ $namaValue }}" />
                                    </div>
                                    <div class="m-2">
                                        <label for="nomor" class="form-label">Nomor Pembayaran</label>
                                        <input type="text" name="nomor" class="form-control" id="nomor"
                                            placeholder="Masukkan Nomor Metode" value="{{ $nomorValue }}" />
                                    </div>
                                    <div class="m-2">
                                        <input type="hidden" name="user" class="form-control" id="user"
                                            value="{{ $user->user_id }}" />
                                        <input type="hidden" name="jenis" class="form-control" id="jenis"
                                            value="{{ ucfirst($method) }}" />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit"
                                        class="btn btn-{{ $hasPaymentMethod ? 'warning' : 'primary' }}" style="background: #06c3ee">{{ $hasPaymentMethod ? 'Ubah' : 'Simpan' }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    {{-- ? Modal Update ? --}}
    <div class="modal fade" data-bs-backdrop="static" id="updateUserModal" tabindex="-1"
        aria-labelledby="updateUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #06c3ee">
                    <h1 class="modal-title fs-5" id="updateUserModalLabel">Ubah
                        Profil</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('data_user.update', ['user_id' => $user->user_id]) }}" method="post"
                    enctype="multipart/form-data">
                    <div class="modal-body row g-3">
                        @csrf
                        @method('PATCH')
                        <div class="d-grid">
                            <label for="profil" class="form-label">Foto Profil</label>
                            <input type="file" name="profil" class="form-control" id="profil"
                                placeholder="Tambahkan Foto Profil" />
                        </div>
                        <div class="col-md-6">
                            <label for="fullname" class="form-label">Nama User</label>
                            <input type="text" name="fullname" class="form-control" id="nama"
                                placeholder="Masukkan Nama User" value="{{ $user->user_fullname }}" />
                        </div>
                        <div class="col-md-6">
                            <label for="username" class="form-label">Username User</label>
                            <input type="text" name="username" class="form-control" id="username"
                                placeholder="Masukkan Username User" value="{{ $user->user_username }}" />
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password User</label>
                            <input type="password" name="password" class="form-control" id="password"
                                placeholder="Masukkan Password User" value="{{ old('password') }}" />
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">E-mail User</label>
                            <input type="email" name="email" class="form-control" id="email"
                                placeholder="Masukkan E-mail User" value="{{ $user->user_email }}" />
                        </div>
                        <div class="col-md-6">
                            <label for="notelp" class="form-label">No. Telp User</label>
                            <input type="number" name="notelp" class="form-control" id="notelp"
                                placeholder="Masukkan No. Telp User" value="{{ $user->user_notelp }}" />
                        </div>
                        <div class="col-md-6">
                            <label for="alamat" class="form-label">Alamat User</label>
                            <input type="text" name="alamat" class="form-control" id="alamat"
                                placeholder="Masukkan Alamat User" value="{{ $user->user_alamat }}" />
                        </div>
                        <div class="col-md-6">
                            <input type="hidden" name="level" class="form-control" id="alamat"
                                value="{{ $user->user_level }}" />
                            <input type="hidden" name="status" class="form-control" id="alamat"
                                value="{{ $user->user_status }}" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn" style="background: #06c3ee">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- ? Logout Delete ? --}}
    <div class="modal fade" data-bs-backdrop="static" id="logoutModal" tabindex="-1"
        aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: #06c3ee">
                    <h1 class="modal-title fs-5" id="logoutModalLabel">
                        Konfirmasi Log-out</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda ingin keluar dari aplikasi?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="{{ route('login') }}">
                        <button class="btn btn-danger">Ya</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <div class="container-flex text-center p-4" style="background: #06c3ee">
        <div class="card text-center" style="background: #06c3ee">
            <div class="card-header" style="background: #06c3ee">
            </div>
            <div class="card-body">
                <h5 class="card-title">Thrift Shop</h5>
                <p class="card-text">Your Wallet is Our Best Friend</p>
                <a href="#" class="btn" style="background-color: #a9e4f1">Affordable Fashion, Unbeatable Prices</a>
            </div>
            <div class="card-footer text-body-secondary" style="background: #06c3ee">
                Copyright &copy; Thrift Shop 2023
            </div>
        </div>
    </div>
@endsection
