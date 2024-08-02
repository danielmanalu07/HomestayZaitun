@extends('Admin.Layout.baselayout')
@section('title')
    Tambah Kategori Kamar
@endsection
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body py-3">
                @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ Session::get('error') }}
                        </button>
                    </div>
                @endif
                <form action="{{ url('/admin/kategori-kamar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            placeholder="Masukkan Nama Kategori" required>
                        @error('nama')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi Kategori</label>
                        <textarea class="form-control" id="deskripsi" rows="3" name="deskripsi" placeholder="Masukkan Deskripsi Kategori"
                            required></textarea>
                        @error('deskripsi')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar Kategori</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" required>
                        @error('gambar')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <img id="preview-image" src="" alt="Preview Image"
                            style="max-height: 200px; display: none;">
                    </div>
                    <button type="submit" class="btn btn-info">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        document.getElementById('gambar').addEventListener('change', function(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview-image');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        });
    </script>
@endpush
