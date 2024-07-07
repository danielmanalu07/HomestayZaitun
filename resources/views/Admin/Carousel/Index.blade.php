@extends('Admin.Layout.baselayout')
@section('title')
    Tambah Data Carousel
@endsection
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <a href="{{ url('/admin/carousel/create') }}" class="btn btn-sm btn-info">Tambah Data</a>
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
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Teks</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($carousels as $key => $item)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td><img src="{{ asset('gambar/carousel/' . $item->gambar) }}" height="100px"
                                        alt=""></td>
                                <td>{{ Str::limit($item->text, 10) }}</td>
                                <td>
                                    <button class="btn btn-info btn-detail" data-text="{{ $item->text }}"
                                        data-gambar="{{ asset('gambar/carousel/' . $item->gambar) }}"><i
                                            class="fas fa-eye"></i></button>
                                    <button class="btn btn-warning btn-edit" data-id="{{ $item->id }}"
                                        data-text="{{ $item->text }}"
                                        data-gambar="{{ asset('gambar/carousel/' . $item->gambar) }}"><i
                                            class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger btn-delete" data-id="{{ $item->id }}"><i
                                            class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>Tidak Ada Data</td>
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
                    <h4 class="modal-title" id="detailDataLabel">Detail Carousel</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Gambar:</strong> <br> <img class="img-fluid" id="dataGambar" alt="Gambar Fasilitas"
                            style="max-width: 50%"></p>
                    <p><strong>Text:</strong> <span id="dataText"></span></p>
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
                    <h4 class="modal-title" id="editDataLabel">Edit Carousel</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editGambar" class="form-label">Gambar Carousel</label>
                            <input type="file" class="form-control" id="editGambar" name="gambar">
                            <img id="currentGambar" class="img-thumbnail mt-2" style="max-width: 100%;">
                        </div>
                        <div class="mb-3">
                            <label for="editText" class="form-label">Text Carousel</label>
                            <textarea class="form-control" name="text" id="editText" rows="3" placeholder="Masukkan Text Carousel"
                                required></textarea>
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
                    var text = this.dataset.text;
                    var gambar = this.dataset.gambar

                    document.getElementById('dataGambar').src = gambar;
                    document.getElementById('dataText').innerText = text;

                    var detailData = new bootstrap.Modal(document.getElementById('detailData'));
                    detailData.show();
                });
            });

            var editButton = document.querySelectorAll('.btn-edit');

            editButton.forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = this.dataset.id;
                    var text = this.dataset.text;
                    var gambar = this.dataset.gambar;

                    document.getElementById('editText').value = text;
                    document.getElementById('currentGambar').src = gambar;

                    var form = document.getElementById('editForm');
                    form.action = '/admin/carousel/' + id;

                    var editData = new bootstrap.Modal(document.getElementById('editData'));
                    editData.show();
                });
            });

            var deleteButton = document.querySelectorAll('.btn-delete');
            deleteButton.forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = this.dataset.id;

                    var form = document.getElementById('deleteForm');
                    form.action = '/admin/carousel/' + id;

                    var deleteModal = new bootstrap.Modal(document.getElementById(
                        'deleteConfirmation'));
                    deleteModal.show();
                });
            });
        });
    </script>
@endpush
