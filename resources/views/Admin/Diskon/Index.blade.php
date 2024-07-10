@extends('Admin.Layout.baselayout')
@section('title')
    Data Diskon
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <a href="{{ url('/admin/diskon/create') }}" class="btn btn-info">Tambah Data</a>
            </div>
            <div class="card-body">
                @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ Session::get('error') }}
                        </button>
                    </div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get('success') }}
                        </button>
                    </div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">No Kamar</th>
                            <th scope="col">Jumlah Diskon</th>
                            <th scope="col">Harga Setelah Diskon</th>
                            <th scope="col">Keterangan Diskon</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($diskons as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->kamar->no_kamar }}</td>
                                <td>{{ intVal($item->jumlah_diskon) }}%</td>
                                <td>Rp. {{ number_format($item->harga_baru) }}</td>
                                <td>{{ Str::limit($item->keterangan, 20) }}</td>
                                <td>
                                    <button class="btn btn-info btn-detail"
                                        data-jumlah_diskon="{{ intVal($item->jumlah_diskon) }}"
                                        data-id_kamar="{{ $item->kamar->no_kamar }}"
                                        data-harga_baru="{{ number_format($item->harga_baru) }}"
                                        data-keterangan="{{ $item->keterangan }}">
                                        <i class="fas fa-eye"></i></button>
                                    <button class="btn btn-warning btn-edit" data-id="{{ $item->id }}"
                                        data-jumlah_diskon="{{ intVal($item->jumlah_diskon) }}"
                                        data-id_kamar="{{ $item->id_kamar }}" data-keterangan="{{ $item->keterangan }}">
                                        <i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger btn-delete" data-id="{{ $item->id }}"><i
                                            class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="6">Tidak Ada Data</td>
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
                    <p><strong>Nomor Kamar:</strong> <span id="modalIdKamar"></span></p>
                    <p><strong>Jumlah Harga Diskon:</strong> <span id="modalJumlahDiskon"></span>%</p>
                    <p><strong>Keterangan Diskon:</strong> <span id="modalKeterangan"></span></p>
                    <p><strong>Harga Setelah Diskon:</strong> Rp. <span id="modalHargaBaru"></span></p>
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
                    <h5 class="modal-title" id="editDataLabel">Edit Kamar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="jumlah_diskon" class="form-label">Jumlah Diskon</label>
                            <span class="text-danger">*</span>
                            <input type="number" class="form-control" id="editJumlahDiskon" name="jumlah_diskon"
                                placeholder="Masukkan Jumlah Diskon" required>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan Diskon</label>
                            <span class="text-danger">*</span>
                            <textarea class="form-control" id="editKeterangan" name="keterangan" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="id_kamar" class="form-label">No Kamar</label>
                            <span class="text-danger">*</span>
                            <select name="id_kamar" id="editIdKamar" class="form-control" required>
                                @forelse ($kamars as $kamar)
                                    <option value="{{ $kamar->id }}">{{ $kamar->no_kamar }}</option>
                                @empty
                                    <option value="">Tidak Ada Data Kamar</option>
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
@endsection
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var detailButtons = document.querySelectorAll('.btn-detail');

            detailButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var jumlah_diskon = this.dataset.jumlah_diskon;
                    var keterangan = this.dataset.keterangan;
                    var harga_baru = this.dataset.harga_baru;
                    var id_kamar = this.dataset.id_kamar;


                    document.getElementById('modalJumlahDiskon').innerText = jumlah_diskon;
                    document.getElementById('modalKeterangan').innerText = keterangan;
                    document.getElementById('modalHargaBaru').innerText = harga_baru;
                    document.getElementById('modalIdKamar').innerText = id_kamar;

                    var detailModal = new bootstrap.Modal(document.getElementById('detailModal'));
                    detailModal.show();
                });
            });

            var editButtons = document.querySelectorAll('.btn-edit');

            editButtons.forEach(function(editButton) {
                editButton.addEventListener('click', function() {
                    var id = this.dataset.id;
                    var jumlah_diskon = this.dataset.jumlah_diskon;
                    var keterangan = this.dataset.keterangan;
                    var id_kamar = this.dataset.id_kamar;

                    document.getElementById('editJumlahDiskon').value = jumlah_diskon;
                    document.getElementById('editKeterangan').value = keterangan;
                    document.getElementById('editIdKamar').value = id_kamar;

                    var form = document.getElementById('editForm');
                    form.action = '/admin/diskon/' + id;

                    var editModal = new bootstrap.Modal(document.getElementById('editData'));
                    editModal.show();
                });
            });

            var deleteButtons = document.querySelectorAll('.btn-delete');

            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = this.dataset.id;

                    var form = document.getElementById('deleteForm');
                    form.action = '/admin/diskon/' + id;

                    var deleteModal = new bootstrap.Modal(document.getElementById(
                        'deleteConfirmationModal'));
                    deleteModal.show();
                });
            });
        });
    </script>
@endpush
