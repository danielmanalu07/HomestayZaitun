@extends('Admin.Layout.baselayout')
@section('title', 'Data Gallery')
@push('css')
    <style>
        .gallery-images img {
            width: 150px;
            height: 100px;
            margin-bottom: 10px;
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
        }

        @media (min-width: 576px) {
            .gallery-images img {
                width: calc(33.333% - 10px);
                margin-right: 10px;
            }
        }

        @media (min-width: 768px) {
            .gallery-images img {
                width: calc(25% - 10px);
                margin-right: 10px;
            }
        }

        .card {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
@endpush
@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Data Gallery</h2>
        <div class="card">
            <div class="card-header">
                <a href="{{ url('/admin/gallery/create') }}" class="btn btn-info">Tambah Data Gallery</a>
            </div>
            <div class="card-body">
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ Session::get('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="row">
                    @foreach ($galleries as $gallery)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <a href="{{ Storage::url($gallery->gambar_utama) }}"
                                    data-lightbox="gallery-{{ $gallery->id }}">
                                    <img src="{{ Storage::url($gallery->gambar_utama) }}" class="card-img-top"
                                        alt="Gambar Utama">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title">No Kamar: {{ $gallery->kamar->no_kamar }}</h5>
                                    <div class="gallery-images">
                                        @if ($gallery->gambar2)
                                            <a href="{{ Storage::url($gallery->gambar2) }}"
                                                data-lightbox="gallery-{{ $gallery->id }}">
                                                <img src="{{ Storage::url($gallery->gambar2) }}" alt="Gambar 2"
                                                    class="img-thumbnail">
                                            </a>
                                        @else
                                            <div class="img-placeholder">Gambar 2 tidak tersedia</div>
                                        @endif

                                        @if ($gallery->gambar3)
                                            <a href="{{ Storage::url($gallery->gambar3) }}"
                                                data-lightbox="gallery-{{ $gallery->id }}">
                                                <img src="{{ Storage::url($gallery->gambar3) }}" alt="Gambar 3"
                                                    class="img-thumbnail">
                                            </a>
                                        @else
                                            <div class="img-placeholder">Gambar 3 tidak tersedia</div>
                                        @endif

                                        @if ($gallery->gambar4)
                                            <a href="{{ Storage::url($gallery->gambar4) }}"
                                                data-lightbox="gallery-{{ $gallery->id }}">
                                                <img src="{{ Storage::url($gallery->gambar4) }}" alt="Gambar 4"
                                                    class="img-thumbnail">
                                            </a>
                                        @else
                                            <div class="img-placeholder">Gambar 4 tidak tersedia</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <button type="button" class="btn btn-warning btn-edit" data-id="{{ $gallery->id }}"
                                        data-gambar_utama="{{ Storage::url($gallery->gambar_utama) }}"
                                        data-gambar2="{{ $gallery->gambar2 ? Storage::url($gallery->gambar2) : '' }}"
                                        data-gambar3="{{ $gallery->gambar3 ? Storage::url($gallery->gambar3) : '' }}"
                                        data-gambar4="{{ $gallery->gambar4 ? Storage::url($gallery->gambar4) : '' }}"
                                        data-id_kamar="{{ $gallery->id_kamar }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-delete" data-id="{{ $gallery->id }}"><i
                                            class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

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
                            <label for="editgambar_utama" class="form-label">Gambar Utama</label>
                            <span class="text-danger">*</span>
                            <input type="file" class="form-control" id="editgambar_utama" name="gambar_utama">
                            <img id="preview-gambar_utama" src="" alt="Preview Image"
                                style="max-height: 200px; display: none;">
                        </div>
                        <div class="mb-3">
                            <label for="editgambar2" class="form-label">Gambar Kedua</label>
                            <input type="file" class="form-control" id="editgambar2" name="gambar2">
                            <img id="preview-gambar2" src="" alt="Preview Image"
                                style="max-height: 200px; display: none;">
                        </div>
                        <div class="mb-3">
                            <label for="editgambar3" class="form-label">Gambar Ketiga</label>
                            <input type="file" class="form-control" id="editgambar3" name="gambar3">
                            <img id="preview-gambar3" src="" alt="Preview Image"
                                style="max-height: 200px; display: none;">
                        </div>
                        <div class="mb-3">
                            <label for="editgambar4" class="form-label">Gambar Keempat</label>
                            <input type="file" class="form-control" id="editgambar4" name="gambar4">
                            <img id="preview-gambar4" src="" alt="Preview Image"
                                style="max-height: 200px; display: none;">
                        </div>
                        <div class="mb-3">
                            <label for="editid_kamar" class="form-label">No Kamar</label>
                            <span class="text-danger">*</span>
                            <select name="id_kamar" id="editid_kamar" class="form-control" required>
                                <option value="">Pilih No Kamar</option>
                                @forelse ($kamars as $kamar)
                                    <option value="{{ $kamar->id }}">{{ $kamar->no_kamar }}</option>
                                @empty
                                    <option value="">Tidak Ada Data Kamar</option>
                                @endforelse
                            </select>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var editButton = document.querySelectorAll('.btn-edit');

            editButton.forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = this.dataset.id;
                    var gambar_utama = this.dataset.gambar_utama;
                    var gambar2 = this.dataset.gambar2;
                    var gambar3 = this.dataset.gambar3;
                    var gambar4 = this.dataset.gambar4;
                    var id_kamar = this.dataset.id_kamar;

                    document.getElementById('preview-gambar_utama').src = gambar_utama;
                    document.getElementById('preview-gambar_utama').style.display = 'block';
                    document.getElementById('preview-gambar2').src = gambar2 ? gambar2 : '';
                    document.getElementById('preview-gambar2').style.display = gambar2 ? 'block' :
                        'none';
                    document.getElementById('preview-gambar3').src = gambar3 ? gambar3 : '';
                    document.getElementById('preview-gambar3').style.display = gambar3 ? 'block' :
                        'none';
                    document.getElementById('preview-gambar4').src = gambar4 ? gambar4 : '';
                    document.getElementById('preview-gambar4').style.display = gambar4 ? 'block' :
                        'none';
                    document.getElementById('editid_kamar').value = id_kamar;

                    var form = document.getElementById('editForm');
                    form.action = '/admin/gallery/' + id;

                    var editData = new bootstrap.Modal(document.getElementById('editData'));
                    editData.show();
                });
            });

            var deleteButtons = document.querySelectorAll('.btn-delete');

            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = this.dataset.id;

                    var form = document.getElementById('deleteForm');
                    form.action = '/admin/gallery/' + id;

                    var deleteModal = new bootstrap.Modal(document.getElementById(
                        'deleteConfirmationModal'));
                    deleteModal.show();
                });
            });


            var editgambar_utama = document.getElementById('editgambar_utama');
            editgambar_utama.addEventListener('change', function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-gambar_utama').src = e.target.result;
                    document.getElementById('preview-gambar_utama').style.display = 'block';
                };
                reader.readAsDataURL(this.files[0]);
            });

            var editgambar2 = document.getElementById('editgambar2');
            editgambar2.addEventListener('change', function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-gambar2').src = e.target.result;
                    document.getElementById('preview-gambar2').style.display = 'block';
                };
                reader.readAsDataURL(this.files[0]);
            });

            var editgambar3 = document.getElementById('editgambar3');
            editgambar3.addEventListener('change', function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-gambar3').src = e.target.result;
                    document.getElementById('preview-gambar3').style.display = 'block';
                };
                reader.readAsDataURL(this.files[0]);
            });

            var editgambar4 = document.getElementById('editgambar4');
            editgambar4.addEventListener('change', function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-gambar4').src = e.target.result;
                    document.getElementById('preview-gambar4').style.display = 'block';
                };
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endpush
