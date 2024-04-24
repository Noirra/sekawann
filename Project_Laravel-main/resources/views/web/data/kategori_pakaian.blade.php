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
    <section class="pt-2 container pb-5">
        <div class="card text-center border-2">
            <div class="card-body" style="background-color: #06c3ee">
                <h2 class="card-title" style="color: white">Kategori Pakaian</h2>
                <h4 class="card-text" style="color: white">Halaman Kategori Pakaian</h4>
            </div>
        </div>
        <div class="container-fluid px-4 pt-4 pb-5">
            <div class="row gap-4 justify-content-sm-around">
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
                <center>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#insertKategoriModal">
                        Tambah Kategori
                    </button>
                </center>
                <div class="table-responsive">
                    <table class="table align-middle table-bordered table-hover">
                        <thead class="align-middle text-center">
                            <tr>
                                <th>No</th>
                                <th>Kategori Nama</th>
                                <th>Kategori Kode</th>
                                <th>Kategori Status</th>
                                <th colspan="2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($kategori_pakaian as $items)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $items->kategori_pakaian_nama }}</td>
                                    <td>{{ $items->kategori_pakaian_kode }}</td>
                                    @switch($items->kategori_pakaian_status)
                                        @case ('0')
                                            <td>
                                                <button type="button" class="btn btn-outline-danger btn-sm w-100">
                                                    Tidak Aktif
                                                </button>
                                            </td>
                                        @break

                                        @case ('1')
                                            <td>
                                                <button type="button" class="btn btn-outline-success btn-sm w-100">
                                                    Aktif
                                                </button>
                                            </td>
                                        @break

                                        @default
                                            <td>
                                                <button type="button" class="btn btn-outline-warning btn-sm w-100">
                                                    Kesalahan Data
                                                </button>
                                            </td>
                                        @break
                                    @endswitch
                                    <td class="text-center">
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#updateKategoriModal_{{ $items->kategori_pakaian_id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteKategoriModal_{{ $items->kategori_pakaian_id }}">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </td>
                                </tr>
                                {{-- ? Modal Update ? --}}
                                <div class="modal fade" data-bs-backdrop="static"
                                    id="updateKategoriModal_{{ $items->kategori_pakaian_id }}" tabindex="-1"
                                    aria-labelledby="updateKategoriModalLabel_{{ $items->kategori_pakaian_id }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: #06c3ee">
                                                <h1 class="modal-title fs-5"
                                                    id="updateKategoriModalLabel_{{ $items->kategori_pakaian_id }}">Ubah
                                                    Data Kategori Pakaian</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form
                                                action="{{ route('kategori_pakaian.update', ['kategori_pakaian_id' => $items->kategori_pakaian_id]) }}"
                                                method="post">
                                                <div class="modal-body">
                                                    @csrf
                                                    @method ('PATCH')
                                                    <div class="m-2">
                                                        <label for="nama" class="form-label">Nama Kategori</label>
                                                        <input type="text" name="nama" class="form-control"
                                                            id="nama" placeholder="Masukkan Nama Kategori"
                                                            value="{{ $items->kategori_pakaian_nama }}" required />
                                                    </div>
                                                    <div class="m-2">
                                                        <label for="kode" class="form-label">Kode Kategori</label>
                                                        <input type="text" name="kode" class="form-control"
                                                            id="kode" placeholder="Masukkan Kode Kategori"
                                                            value="{{ $items->kategori_pakaian_kode }}" required />
                                                    </div>
                                                    <div class="m-2 d-grid">
                                                        <label for="kode" class="form-label">Status Aktif</label>
                                                        <div class="btn-group" role="group"
                                                            aria-label="Basic radio toggle button group">
                                                            <input type="radio" class="btn-check" name="status"
                                                                id="status1_{{ $items->kategori_pakaian_id }}"
                                                                value="1" autocomplete="off"
                                                                {{ $items->kategori_pakaian_status != 0 ? 'checked' : '' }}
                                                                required>
                                                            <label class="btn btn-outline-success"
                                                                for="status1_{{ $items->kategori_pakaian_id }}">Aktif</label>
                                                            <input type="radio" class="btn-check" name="status"
                                                                id="status2_{{ $items->kategori_pakaian_id }}"
                                                                value="0" autocomplete="off"
                                                                {{ $items->kategori_pakaian_status == 0 ? 'checked' : '' }}
                                                                required>
                                                            <label class="btn btn-outline-danger"
                                                                for="status2_{{ $items->kategori_pakaian_id }}">Tidak
                                                                Aktif</label>
                                                        </div>
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
                                    id="deleteKategoriModal_{{ $items->kategori_pakaian_id }}" tabindex="-1"
                                    aria-labelledby="deleteKategoriModalLabel_{{ $items->kategori_pakaian_id }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: #06c3ee">
                                                <h1 class="modal-title fs-5"
                                                    id="deleteKategoriModalLabel_{{ $items->kategori_pakaian_id }}">
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
                                                    action="{{ route('kategori_pakaian.delete', ['kategori_pakaian_id' => $items->kategori_pakaian_id]) }}"
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
                            <div class="modal fade" data-bs-backdrop="static" id="insertKategoriModal" tabindex="-1"
                                aria-labelledby="insertKategoriModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #06c3ee">
                                            <h1 class="modal-title fs-5" id="insertKategoriModalLabel">Tambah Data
                                                Kategori Pakaian</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('action.create_kategori_pakaian') }}" method="post">
                                            <div class="modal-body">
                                                @csrf
                                                <div class="m-2">
                                                    <label for="nama" class="form-label">Nama Kategori</label>
                                                    <input type="text" name="nama" class="form-control"
                                                        id="nama" placeholder="Masukkan Nama Kategori" required />
                                                </div>
                                                <div class="m-2">
                                                    <label for="kode" class="form-label">Kode Kategori</label>
                                                    <input type="text" name="kode" class="form-control"
                                                        id="kode" placeholder="Masukkan Kode Kategori" required />
                                                </div>
                                                <div class="m-2 d-grid">
                                                    <label for="kode" class="form-label">Status Aktif</label>
                                                    <div class="btn-group" role="group"
                                                        aria-label="Basic radio toggle button group">
                                                        <input type="radio" class="btn-check" name="status"
                                                            id="status1" value="1" autocomplete="off" checked
                                                            required>
                                                        <label class="btn btn-outline-success"
                                                            for="status1">Aktif</label>
                                                        <input type="radio" class="btn-check" name="status"
                                                            id="status2" value="0" autocomplete="off">
                                                        <label class="btn btn-outline-danger" for="status2">Tidak
                                                            Aktif</label>
                                                    </div>
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
                    {{ $kategori_pakaian->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    <div class="fixed-bottom p-3 bg-dark-subtle">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Thrift Shop 2023</div>
        </div>
    </div>
@endsection
