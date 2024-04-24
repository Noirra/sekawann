@extends('layouts.app')

@auth
    @php $userRole = Auth::user()->user_level; @endphp
@endauth

@section('title', 'Detail Pakaian')

@section('header')
    <style>
        body {
            background-color: whitesmoke;
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
    @php
        $kategori_pakaian = \App\Models\Kategori_Pakaian::find($detail->pakaian_kategori_pakaian_id);
    @endphp
    <div class="container-fluid p-3" style="background: whitesmoke">
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
        <div class="card text-bg-dark mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    @if ($detail->pakaian_gambar_url === '' || $detail->pakaian_gambar_url === null)
                        <img src="{{ asset('img/clothes.png') }}" class="img-fluid ratio-1x1" alt="...">
                    @else
                        <img src="{{ asset('storage/pakaian/gambar/' . basename($detail->pakaian_gambar_url)) }}"
                            class="img-fluid ratio-1x1" alt="...">
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <ul class="list-group mt-3">
                            <li class="list-group-item">
                                <h2>{{ $detail->pakaian_nama }}</h2>
                            </li>
                            <li class="list-group-item">
                                <h3>Kategori : {{ $kategori_pakaian->kategori_pakaian_nama }}</h3>
                            </li>
                            <li class="list-group-item">
                                <h5>Stok Tersisa : {{ $detail->pakaian_stok }}</h5>
                            </li>
                            <li class="list-group-item">
                                <h5>Harga : Rp.{{ $detail->pakaian_harga }}</h5>
                            </li>
                        </ul>
                        <?php
                        $cart = Session::get('cart', []);
                        $foundInCart = false;
                        foreach ($cart as $item) {
                            if ($item['id'] == $detail->pakaian_id) {
                                $foundInCart = true;
                                break;
                            }
                        }
                        ?>
                        @if ($foundInCart)
                            <button type="button" class="btn btn-warning mt-2" disabled>Already in Cart</button>
                        @else
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $detail->pakaian_id }}">
                                <input type="hidden" name="product_jumlah" value="1">
                                <button type="submit" class="btn mt-2" style="background: #06c3ee">Tambah ke Keranjang</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid text-center">
        <h3>Pakaian Lain</h3>
        <div class="d-flex flex-wrap justify-content-evenly">
            @foreach ($data_pakaian as $items)
                @php
                    $kategori = \App\Models\Kategori_Pakaian::find($items->pakaian_kategori_pakaian_id);
                    $pakaianStok = $items->pakaian_stok;
                    $kategoriStatus = $kategori->kategori_pakaian_status;
                @endphp
                @if ($pakaianStok > 0 && $kategoriStatus > 0)
                    <div class="card text-bg-dark m-2" style="width: 18rem;">
                        <img width="100%" height="100%"
                            src="{{ asset('storage/pakaian/gambar/' . basename($items->pakaian_gambar_url)) }}"
                            class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $items->pakaian_nama }}</h5>
                            <p class="card-text">Rp. {{ $items->pakaian_harga }}</p>
                            <a href="{{ route('detail', ['pakaian_id' => $items->pakaian_id]) }}"
                                class="btn" style="background: #06c3ee">Lihat Detail</a>
                        </div>
                    </div>
                @endif
            @endforeach
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
                <a href="#" class="btn btn-primary">Affordable Fashion, Unbeatable Prices</a>
            </div>
            <div class="card-footer text-body-secondary" style="background: #06c3ee">
                Copyright &copy; Thrift Shop 2023
            </div>
        </div>
    </div>
@endsection
