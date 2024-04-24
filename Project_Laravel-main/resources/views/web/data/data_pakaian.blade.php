@extends('layouts.app')

@section('title', 'Halaman Dashboard')

@auth
    @php $userRole = Auth::user()->user_level; @endphp
@endauth

@section('header')
    <style>
        body {
            background: linear-gradient(to right, #a9e4f1, #ffffff);
            width: 100vw;
            height: 100vh;
            font-family: 'Arial', sans-serif;
        }

        ::-webkit-scrollbar {
            width: 0px;
        }
    </style>
    @include('layouts.nav_admin')
@endsection

@section('main')
    <section class="pt-5 container pb-5">
        <div class="card text-center border-2">
            <div class="card-body" style="background-color: #06c3ee; color: white;">
                <h2 class="card-title">Kategori Pakaian</h2>
                <h4 class="card-text">Selamat datang di Halaman Kategori Pakaian</h4>
            </div>
        </div>
        <div class="container-fluid px-4 pt-4 pb-5">
            <div class="row gap-4 justify-content-center">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Sukses!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session('updated'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <strong>Sukses!</strong> {{ session('updated') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session('deleted'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Sukses!</strong> {{ session('deleted') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Gagal!</strong> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="text-center mt-4">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#insertPakaianModal">
                        Tambah Pakaian
                    </button>
                </div>
                <div class="table-responsive mt-4">
                    <table class="table align-middle table-bordered table-hover">
                        <thead class="align-middle text-center">
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama Pakaian</th>
                                <th>Kategori Pakaian</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th colspan="2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($data_pakaian as $items)
                                <?php $kategori = \App\Models\Kategori_Pakaian::find($items->pakaian_kategori_pakaian_id); ?>
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        @if ($items->pakaian_gambar_url === '' || $items->pakaian_gambar_url === null)
                                            <img width="100px" height="100px" src="{{ asset('img/clothes.png') }}"
                                                alt="..." class="img-profile img-thumbnail">
                                        @else
                                            <img width="100px" height="100px"
                                                src="{{ asset('storage/pakaian/gambar/' . basename($items->pakaian_gambar_url)) }}"
                                                alt="..." class="img-profile img-thumbnail">
                                        @endif
                                    </td>
                                    <td>{{ $items->pakaian_nama }}</td>
                                    <td>{{ $kategori->kategori_pakaian_nama }}</td>
                                    <td>{{ $items->pakaian_harga }}</td>
                                    <td>{{ $items->pakaian_stok }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#updatePakaianModal_{{ $items->pakaian_id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deletePakaianModal_{{ $items->pakaian_id }}">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </td>
                                </tr>
                                {{-- ? Modal Update ? --}}
                                <div class="modal fade" data-bs-backdrop="static"
                                    id="updatePakaianModal_{{ $items->pakaian_id }}" tabindex="-1"
                                    aria-labelledby="updatePakaianModalLabel_{{ $items->pakaian_id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: #06c3ee">
                                                <h1 class="modal-title fs-5"
                                                    id="updatePakaianModalLabel_{{ $items->pakaian_id }}">Ubah
                                                    Data Pakaian</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form
                                                action="{{ route('data_pakaian.update', ['pakaian_id' => $items->pakaian_id]) }}"
                                                method="post" enctype="multipart/form-data">
                                                <div class="modal-body row g-3">
                                                    @csrf
                                                    @method ('PATCH')
                                                    <div class="d-grid">
                                                        <label for="gambar" class="form-label">Gambar Pakaian</label>
                                                        <input type="file" name="gambar" class="form-control"
                                                            id="gambar" required />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="nama" class="form-label">Nama Pakaian</label>
                                                        <input type="text" name="nama" class="form-control"
                                                            id="nama" placeholder="Masukkan Nama Pakaian"
                                                            value="{{ $items->pakaian_nama }}" required />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="kategori" class="form-label">Kategori Pakaian</label>
                                                        <select class="form-control" name="kategori" id="kategori"
                                                            required>
                                                            <option disabled selected>- Pilih Kategori Pakaian -</option>
                                                            @foreach ($kategori_pakaian as $item)
                                                                @if ($item->kategori_pakaian_status == 1)
                                                                    <option value="{{ $item->kategori_pakaian_id }}"
                                                                        {{ $item->kategori_pakaian_id == $items->pakaian_kategori_pakaian_id ? 'selected' : '' }}>
                                                                        {{ $item->kategori_pakaian_nama }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="harga" class="form-label">Harga Pakaian</label>
                                                        <input type="number" name="harga" class="form-control"
                                                            id="harga" placeholder="Masukkan Harga Pakaian"
                                                            value="{{ $items->pakaian_harga }}" required />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="stok" class="form-label">Stok Pakaian</label>
                                                        <input type="number" name="stok" class="form-control"
                                                            id="stok" placeholder="Masukkan Stok Pakaian"
                                                            value="{{ $items->pakaian_stok }}" required />
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn" style="background-color: #06c3ee">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- ? Modal Delete ? --}}
                                <div class="modal fade" data-bs-backdrop="static"
                                    id="deletePakaianModal_{{ $items->pakaian_id }}" tabindex="-1"
                                    aria-labelledby="deletePakaianModalLabel_{{ $items->pakaian_id }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: #06c3ee">
                                                <h1 class="modal-title fs-5"
                                                    id="deletePakaianModalLabel_{{ $items->pakaian_id }}">
                                                    Konfirmasi Hapus</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Data yang dipilih akan dihapus? Apakah anda yakin?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tidak (Batal Hapus)</button>
                                                <form class="d-grid"
                                                    action="{{ route('data_pakaian.delete', ['pakaian_id' => $items->pakaian_id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger">Ya (Konfirmasi Hapus)</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{-- ? Modal Insert ? --}}
                            <div class="modal fade" data-bs-backdrop="static" id="insertPakaianModal" tabindex="-1"
                                aria-labelledby="insertPakaianModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #06c3ee">
                                            <h1 class="modal-title fs-5" id="insertPakaianModalLabel">Tambah Data Pakaian
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('action.create_data_pakaian') }}" method="post"
                                            enctype="multipart/form-data">
                                            <div class="modal-body row g-3">
                                                @csrf
                                                <div class="d-grid">
                                                    <label for="gambar" class="form-label">Gambar Pakaian</label>
                                                    <input type="file" name="gambar" class="form-control"
                                                        id="gambar" required />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="nama" class="form-label">Nama Pakaian</label>
                                                    <input type="text" name="nama" class="form-control"
                                                        id="nama" placeholder="Masukkan Nama Pakaian" required />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="kategori" class="form-label">Kategori Pakaian</label>
                                                    <select class="form-control" name="kategori" id="kategori" required>
                                                        <option disabled selected>- Pilih Kategori Pakaian -</option>
                                                        @foreach ($kategori_pakaian as $item)
                                                            @if ($item->kategori_pakaian_status == 1)
                                                                <option value="{{ $item->kategori_pakaian_id }}">
                                                                    {{ $item->kategori_pakaian_nama }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="harga" class="form-label">Harga Pakaian</label>
                                                    <input type="number" name="harga" class="form-control"
                                                        id="harga" placeholder="Masukkan Harga Pakaian" required />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="stok" class="form-label">Stok Pakaian</label>
                                                    <input type="number" name="stok" class="form-control"
                                                        id="stok" placeholder="Masukkan Stok Pakaian" required />
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn" style="background-color: #06c3ee">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </tbody>
                    </table>
                    {{ $data_pakaian->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    <div class="fixed-bottom p-3" style="background-color: #06c3ee; color: white;">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Thrift Shop 2023</div>
        </div>
    </div>
@endsection
