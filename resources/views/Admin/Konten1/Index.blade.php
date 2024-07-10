@extends('Admin.Layout.baselayout')
@section('title')
    Data Konten 1
@endsection
@push('css')
    <style>
        .custom-img {
            width: 300px;
            height: auto;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <a href="{{ url('/admin/konten1/create') }}" class="btn btn-info">Tambah Data</a>
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
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Teks</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($konten as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td class="text-center">
                                    <img src="{{ asset('gambar/konten/' . $item->gambar) }}" alt="Gambar Konten"
                                        class="img-fluid custom-img">
                                </td>
                                <td>{{ Str::limit($item->teks, 20) }}</td>
                                <td>
                                    <button class="btn btn-info btn-detail" data-teks="{{ $item->teks }}"
                                        data-gambar="{{ asset('gambar/konten/' . $item->gambar) }}"><i
                                            class="fas fa-eye"></i></button>
                                    <button class="btn btn-warning btn-edit" data-id="{{ $item->id }}"
                                        data-teks="{{ $item->teks }}"
                                        data-gambar="{{ asset('gambar/konten/' . $item->gambar) }}"><i
                                            class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger btn-delete" data-id="{{ $item->id }}"><i
                                            class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak Ada Data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Detail View --}}
    <div class="modal fade" id="detailData" tabindex="-1" aria-labelledby="detailDataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="detailDataLabel">Detail Konten</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Gambar:</strong> <br> <img class="img-fluid" id="dataGambar" alt="Gambar Konten"
                            style="max-width: 50%"></p>
                    <p><strong>Teks:</strong> <span id="dataTeks"></span></p>
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
                    <h4 class="modal-title" id="editDataLabel">Edit Konten</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editGambar" class="form-label">Gambar Konten</label>
                            <input type="file" class="form-control" id="editGambar" name="gambar">
                            <img id="currentGambar" class="img-thumbnail mt-2" style="max-width: 100%;">
                        </div>
                        <div class="mb-3">
                            <label for="editTeks" class="form-label">Teks Konten</label>
                            <textarea class="form-control" name="teks" id="editTeks" rows="3" placeholder="Masukkan Teks Konten" required></textarea>
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
                    var teks = this.dataset.teks;
                    var gambar = this.dataset.gambar

                    document.getElementById('dataGambar').src = gambar;
                    document.getElementById('dataTeks').innerText = teks;

                    var detailData = new bootstrap.Modal(document.getElementById('detailData'));
                    detailData.show();
                });
            });

            var editButton = document.querySelectorAll('.btn-edit');

            editButton.forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = this.dataset.id;
                    var teks = this.dataset.teks;
                    var gambar = this.dataset.gambar;

                    document.getElementById('editTeks').value = teks;
                    document.getElementById('currentGambar').src = gambar;

                    var form = document.getElementById('editForm');
                    form.action = '/admin/konten1/' + id;

                    var editData = new bootstrap.Modal(document.getElementById('editData'));
                    editData.show();
                });
            });

            var deleteButton = document.querySelectorAll('.btn-delete');
            deleteButton.forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = this.dataset.id;

                    var form = document.getElementById('deleteForm');
                    form.action = '/admin/konten1/' + id;

                    var deleteModal = new bootstrap.Modal(document.getElementById(
                        'deleteConfirmation'));
                    deleteModal.show();
                });
            });
        });
    </script>
@endpush
