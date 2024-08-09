@extends('Admin.Layout.baselayout')
@section('title')
    Data Fasilitas
@endsection
@push('css')
    <style>
        .img-thumbnail {
            max-height: 200px;
            object-fit: cover;
        }

        .card-data {
            background-color: gainsboro;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <a href="{{ url('/admin/fasilitas/create') }}" class="btn btn-sm btn-info">Tambah Data</a>
            </div>
            <div class="card-body">
                @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ Session::get('error') }}
                    </div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif
                <div class="row">
                    @forelse ($fasilitas as $item)
                        <div class="col-md-3 col-sm-6">
                            <div class="card card-data my-2">
                                <img src="{{ asset('gambar/fasilitas/' . $item->gambar) }}"
                                    class="card-img-top img-thumbnail" alt="image_fasilitas">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->nama }}</h5>
                                    <p class="card-text">{{ Str::limit($item->deskripsi, 30) }}</p>
                                    <button class="btn btn-info btn-detail" data-nama="{{ $item->nama }}"
                                        data-deskripsi="{{ $item->deskripsi }}"
                                        data-gambar="{{ asset('gambar/fasilitas/' . $item->gambar) }}"><i
                                            class="fas fa-eye"></i></button>
                                    <button class="btn btn-warning btn-edit" data-id="{{ $item->id }}"
                                        data-deskripsi="{{ $item->deskripsi }}" data-nama="{{ $item->nama }}"
                                        data-gambar="{{ asset('gambar/fasilitas/' . $item->gambar) }}"><i
                                            class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger btn-delete" data-id="{{ $item->id }}"><i
                                            class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="card bg-light my-2">
                                <h1>Tidak Ada Data</h1>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Detail View --}}
    <div class="modal fade" id="detailData" tabindex="-1" aria-labelledby="detailDataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="detailDataLabel">Detail Fasilitas</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Gambar:</strong> <br> <img class="img-fluid" id="dataGambar" alt="Gambar Fasilitas"
                            style="max-width: 50%"></p>
                    <p><strong>Nama:</strong> <span id="dataNama"></span></p>
                    <p><strong>Deskripsi:</strong> <span id="dataDeskripsi"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Detail View --}}


    {{-- Edit Data View --}}
    <div class="modal fade" id="editData" tabindex="-1" aria-labelledby="editDataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="editDataLabel">Edit Fasilitas</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editNama" class="form-label">Nama Fasilitas</label>
                            <input type="text" class="form-control" id="editNama" name="nama"
                                placeholder="Masukkan Nama Fasilitas" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDeskripsi" class="form-label">Deskripsi Fasilitas</label>
                            <textarea class="form-control" name="deskripsi" id="editDeskripsi" rows="3"
                                placeholder="Masukkan Deskripsi Fasilitas" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editGambar" class="form-label">Gambar Fasilitas</label>
                            <input type="file" class="form-control" id="editGambar" name="gambar">
                            <img id="currentGambar" class="img-thumbnail mt-2" style="max-width: 100%;">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-info">Simpan Data</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Edit Data View --}}

    {{-- Delete Data Confirmation --}}
    <div class="modal fade" id="deleteConfirmation" tabindex="-1" aria-labelledby="deleteConfirmationLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="deleteConfirmationLabel">Konfirmasi Penghapusan</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data ini?
                </div>
                <div class="modal-footer">
                    <form method="POST" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End Delete Data Confirmation --}}
@endsection
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var detailButton = document.querySelectorAll('.btn-detail');

            detailButton.forEach(function(button) {
                button.addEventListener('click', function() {
                    var nama = this.dataset.nama;
                    var deskripsi = this.dataset.deskripsi;
                    var gambar = this.dataset.gambar

                    document.getElementById('dataGambar').src = gambar;
                    document.getElementById('dataNama').innerText = nama;
                    document.getElementById('dataDeskripsi').innerText = deskripsi;

                    var detailData = new bootstrap.Modal(document.getElementById('detailData'));
                    detailData.show();
                });
            });

            var editButton = document.querySelectorAll('.btn-edit');

            editButton.forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = this.dataset.id;
                    var nama = this.dataset.nama;
                    var deskripsi = this.dataset.deskripsi;
                    var gambar = this.dataset.gambar;

                    document.getElementById('editNama').value = nama;
                    document.getElementById('editDeskripsi').value = deskripsi;
                    document.getElementById('currentGambar').src = gambar;

                    var form = document.getElementById('editForm');
                    form.action = '/admin/fasilitas/' + id;

                    var editData = new bootstrap.Modal(document.getElementById('editData'));
                    editData.show();
                });
            });


            var deleteButton = document.querySelectorAll('.btn-delete');
            deleteButton.forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = this.dataset.id;

                    var form = document.getElementById('deleteForm');
                    form.action = '/admin/fasilitas/' + id;

                    var deleteModal = new bootstrap.Modal(document.getElementById(
                        'deleteConfirmation'));
                    deleteModal.show();
                });
            });
        });
    </script>
@endpush
