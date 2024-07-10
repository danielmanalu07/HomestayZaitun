@extends('Admin.Layout.baselayout')
@section('title')
    Tambah Data Konten 1
@endsection
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ Session::get('error') }}
                        </button>
                    </div>
                @endif
                <form action="{{ url('/admin/konten1') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar Konten</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" required>
                    </div>
                    <div class="mb-3">
                        <img id="preview-image" src="" alt="Preview Image"
                            style="max-height: 200px; display: none;">
                    </div>
                    <div class="mb-3">
                        <label for="teks" class="form-label">Teks Konten</label>
                        <textarea class="form-control" id="teks" rows="3" name="teks" placeholder="Masukkan Teks Konten" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
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
