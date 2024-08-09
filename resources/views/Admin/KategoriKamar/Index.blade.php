@extends('Admin.Layout.baselayout')
@section('title')
    Data Kategori Kamar
@endsection
@push('css')
    <style>
        .img-kategori {
            width: 200px;
            border-radius: 3%
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <a href="{{ url('/admin/kategori-kamar/create') }}" class="btn btn-info btn-sm my-2">Tambah Data</a>
        <div class="card">
            <div class="card-body">
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kategori_kamars as $key => $item)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $item->nama }}</td>
                                <td>{{ Str::limit($item->deskripsi, 10) }}</td>
                                <td><img src="{{ asset('gambar/kategoriKamar/' . $item->gambar) }}" alt="Image Kategori"
                                        class="img-kategori">
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-info btn-detail" data-nama="{{ $item->nama }}"
                                        data-deskripsi="{{ $item->deskripsi }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-warning btn-edit" data-id="{{ $item->id }}"
                                        data-nama="{{ $item->nama }}" data-deskripsi="{{ $item->deskripsi }}"
                                        data-gambar="{{ asset('gambar/kategoriKamar/' . $item->gambar) }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $item->id }}"><i
                                            class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Tidak Ada Data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Detail View --}}
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Kategori Kamar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Nama:</strong> <span id="modalNama"></span></p>
                    <p><strong>Deskripsi:</strong> <br><span id="modalDeskripsi"></span></p>
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
                    <h5 class="modal-title" id="editDataLabel">Edit Kategori Kamar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editNama" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" id="editNama" name="nama"
                                placeholder="Masukkan Nama Kategori" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDeskripsi" class="form-label">Deskripsi Kategori</label>
                            <textarea class="form-control" id="editDeskripsi" rows="3" name="deskripsi"
                                placeholder="Masukkan Deskripsi Kategori" required></textarea>
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


    {{-- Delete Confirmation View --}}
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationLabel">Konfirmasi Penghapusan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data ini?
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End Delete Confirmation View --}}
@endsection
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var detailButtons = document.querySelectorAll('.btn-detail');

            detailButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var nama = this.dataset.nama;
                    var deskripsi = this.dataset.deskripsi;

                    document.getElementById('modalNama').innerText = nama;
                    document.getElementById('modalDeskripsi').innerText = deskripsi;

                    var detailModal = new bootstrap.Modal(document.getElementById('detailModal'));
                    detailModal.show();
                });
            });

            var editButtons = document.querySelectorAll('.btn-edit');

            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = this.dataset.id;
                    var nama = this.dataset.nama;
                    var deskripsi = this.dataset.deskripsi;
                    var gambar = this.dataset.gambar;

                    document.getElementById('editNama').value = nama;
                    document.getElementById('editDeskripsi').value = deskripsi;
                    document.getElementById('currentGambar').src = gambar;

                    var form = document.getElementById('editForm');
                    form.action = '/admin/kategori-kamar/' + id;

                    var editModal = new bootstrap.Modal(document.getElementById('editData'));
                    editModal.show();
                });
            });

            var deleteButtons = document.querySelectorAll('.btn-delete');

            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = this.dataset.id;

                    var form = document.getElementById('deleteForm');
                    form.action = '/admin/kategori-kamar/' + id;

                    var deleteModal = new bootstrap.Modal(document.getElementById(
                        'deleteConfirmationModal'));
                    deleteModal.show();
                });
            });
        });
    </script>
@endpush
