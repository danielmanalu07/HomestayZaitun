@extends('Admin.Layout.baselayout')
@section('title')
    Data Kamar
@endsection
@push('css')
    <style>
        .carousel-item img {
            max-height: 500px;
            /* Atur tinggi maksimum gambar */
            object-fit: cover;
            /* Memastikan gambar di-crop agar sesuai dengan container */
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <a href="{{ url('/admin/kamar/create') }}" class="btn btn-sm btn-info">Tambah Data</a>
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
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">No Kamar</th>
                            <th scope="col">Harga Kamar</th>
                            <th scope="col">Kapasitas</th>
                            <th scope="col">Status</th>
                            <th scope="col">View</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kamars as $key => $item)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $item->no_kamar }}</td>
                                <td>Rp. {{ number_format($item->harga_kamar) }}</td>
                                <td>{{ $item->kapasitas }}</td>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->view }}</td>
                                <td>{{ $item->kategoriKamar->nama }}</td>
                                <td>
                                    <button type="button" class="btn btn-secondary btn-view-images"
                                        data-id="{{ $item->id }}" data-bs-toggle="modal"
                                        data-bs-target="#viewImagesModal">
                                        Lihat Gambar
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-edit" data-id="{{ $item->id }}"
                                        data-no_kamar="{{ $item->no_kamar }}" data-harga_kamar="{{ $item->harga_kamar }}"
                                        data-kapasitas="{{ $item->kapasitas }}"
                                        data-id_kategori="{{ $item->id_kategori }}"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger btn-delete" data-id="{{ $item->id }}"><i
                                            class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">Tidak Ada Data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Edit Data View --}}
    <div class="modal fade" id="editData" tabindex="-1" aria-labelledby="editDataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDataLabel">Edit Kamar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="no_kamar" class="form-label">Nomor Kamar</label>
                            <input type="number" class="form-control" id="editNoKamar" name="no_kamar"
                                placeholder="Masukkan Nomor Kamar" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga_kamar" class="form-label">Harga Kamar</label>
                            <input type="number" name="harga_kamar" id="editHargaKamar" class="form-control"
                                placeholder="Masukkan Harga Kamar" required>
                        </div>
                        <div class="mb-3">
                            <label for="kapasitas" class="form-label">Kapasitas Kamar</label>
                            <input type="number" name="kapasitas" id="editKapasitas" class="form-control"
                                placeholder="Masukkan Kapasitas Kamar" required>
                        </div>
                        <div class="mb-3">
                            <label for="id_kategori" class="form-label">Kategori Kamar</label>
                            <select name="id_kategori" id="editKategori" class="form-control" required>
                                <option value="">Pilih Kategori Kamar</option>
                                @forelse ($kategori_kamars as $kategori_kamar)
                                    <option value="{{ $kategori_kamar->id }}">{{ $kategori_kamar->nama }}</option>
                                @empty
                                    <option value="">Tidak Ada Data Kategori Kamar</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Update Data</button>
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

    {{-- View Images Modal --}}
    <div class="modal fade" id="viewImagesModal" tabindex="-1" aria-labelledby="viewImagesModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewImagesModalLabel">Lihat Gambar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="carouselImages" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner" id="carousel-inner"></div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselImages"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselImages"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End View Images Modal --}}
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var editButtons = document.querySelectorAll('.btn-edit');

            editButtons.forEach(function(editButton) {
                editButton.addEventListener('click', function() {
                    var id = this.dataset.id;
                    var no_kamar = this.dataset.no_kamar;
                    var harga_kamar = this.dataset.harga_kamar;
                    var kapasitas = this.dataset.kapasitas;
                    var id_kategori = this.dataset.id_kategori;

                    document.getElementById('editNoKamar').value = no_kamar;
                    document.getElementById('editHargaKamar').value = harga_kamar;
                    document.getElementById('editKapasitas').value = kapasitas;
                    document.getElementById('editKategori').value = id_kategori;

                    var form = document.getElementById('editForm');
                    form.action = '/admin/kamar/' + id;

                    var editModal = new bootstrap.Modal(document.getElementById('editData'));
                    editModal.show();
                });
            });

            var deleteButtons = document.querySelectorAll('.btn-delete');

            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = this.dataset.id;

                    var form = document.getElementById('deleteForm');
                    form.action = '/admin/kamar/' + id;

                    var deleteModal = new bootstrap.Modal(document.getElementById(
                        'deleteConfirmationModal'));
                    deleteModal.show();
                });
            });

            var viewImageButtons = document.querySelectorAll('.btn-view-images');

            viewImageButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = this.dataset.id;
                    fetch(`/admin/kamar/${id}/images`)
                        .then(response => response.json())
                        .then(data => {
                            var carouselInner = document.getElementById('carousel-inner');
                            carouselInner.innerHTML = '';
                            var hasImages = false;

                            ['gambar_utama', 'gambar2', 'gambar3', 'gambar4'].forEach(function(
                                key, index) {
                                if (data[key]) {
                                    hasImages = true;
                                    var div = document.createElement('div');
                                    div.className = 'carousel-item' + (index === 0 ?
                                        ' active' : '');
                                    var img = document.createElement('img');
                                    img.src = data[key];
                                    img.className =
                                        'd-block w-100 img-fluid';
                                    div.appendChild(img);
                                    carouselInner.appendChild(div);
                                }
                            });

                            if (!hasImages) {
                                var div = document.createElement('div');
                                div.className = 'carousel-item active';
                                div.innerHTML =
                                    '<p class="text-center">Tidak ada gambar tersedia</p>';
                                carouselInner.appendChild(div);
                            }

                            var carousel = new bootstrap.Carousel(document.getElementById(
                                'carouselImages'));
                        });
                });
            });
        });
    </script>
@endpush
