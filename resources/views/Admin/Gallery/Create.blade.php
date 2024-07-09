@extends('Admin.Layout.baselayout')
@section('title')
    Tambah Data Gallery
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <p class="card-title">Note: <span class="text-danger">(*)</span> Harus diisi</p>
            </div>
            <div class="card-body">
                @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ Session::get('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form action="{{ url('/admin/gallery') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="gambar_utama" class="form-label">Gambar Utama</label>
                        <span class="text-danger">*</span>
                        <input type="file" class="form-control" id="gambar_utama" name="gambar_utama" required>
                        <img id="preview-gambar_utama" src="" alt="Preview Image"
                            style="max-height: 200px; display: none;">
                    </div>
                    <div class="mb-3">
                        <label for="gambar2" class="form-label">Gambar Kedua</label>
                        <input type="file" class="form-control" id="gambar2" name="gambar2">
                        <img id="preview-gambar2" src="" alt="Preview Image"
                            style="max-height: 200px; display: none;">
                    </div>
                    <div class="mb-3">
                        <label for="gambar3" class="form-label">Gambar Ketiga</label>
                        <input type="file" class="form-control" id="gambar3" name="gambar3">
                        <img id="preview-gambar3" src="" alt="Preview Image"
                            style="max-height: 200px; display: none;">
                    </div>
                    <div class="mb-3">
                        <label for="gambar4" class="form-label">Gambar Keempat</label>
                        <input type="file" class="form-control" id="gambar4" name="gambar4">
                        <img id="preview-gambar4" src="" alt="Preview Image"
                            style="max-height: 200px; display: none;">
                    </div>
                    <div class="mb-3">
                        <label for="id_kamar" class="form-label">No Kamar</label>
                        <span class="text-danger">*</span>
                        <select name="id_kamar" id="id_kamar" class="form-control" required>
                            <option value="">Pilih No Kamar</option>
                            @forelse ($kamars as $kamar)
                                <option value="{{ $kamar->id }}">{{ $kamar->no_kamar }}</option>
                            @empty
                                <option value="">Tidak Ada Data Kamar</option>
                            @endforelse
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function previewImage(inputId, imgId) {
            document.getElementById(inputId).addEventListener('change', function(event) {
                var reader = new FileReader();
                reader.onload = function() {
                    var output = document.getElementById(imgId);
                    output.src = reader.result;
                    output.style.display = 'block';
                };
                reader.readAsDataURL(event.target.files[0]);
            });
        }

        previewImage('gambar_utama', 'preview-gambar_utama');
        previewImage('gambar2', 'preview-gambar2');
        previewImage('gambar3', 'preview-gambar3');
        previewImage('gambar4', 'preview-gambar4');
    </script>
@endpush
