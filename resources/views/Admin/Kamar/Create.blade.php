@extends('Admin.Layout.baselayout')
@section('title')
    Tambah Data Kamar
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ Session::get('error') }}
                        </button>
                    </div>
                @endif
                <form action="{{ url('/admin/kamar') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="no_kamar" class="form-label">Nomor Kamar</label>
                        <input type="number" class="form-control" id="no_kamar" name="no_kamar"
                            placeholder="Masukkan Nomor Kamar" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga_kamar" class="form-label">Harga Kamar</label>
                        <input type="number" name="harga_kamar" id="harga_kamar" class="form-control"
                            placeholder="Masukkan Harga Kamar" required>
                    </div>
                    <div class="mb-3">
                        <label for="kapasitas" class="form-label">Kapasitas Kamar</label>
                        <input type="number" name="kapasitas" id="kapasitas" class="form-control"
                            placeholder="Masukkan Kapasitas Kamar" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_kategori" class="form-label">Kategori Kamar</label>
                        <select name="id_kategori" id="id_kategori" class="form-control" required>
                            <option value="">Pilih Kategori Kamar</option>
                            @forelse ($kategori_kamars as $kategori_kamar)
                                <option value="{{ $kategori_kamar->id }}">{{ $kategori_kamar->nama }}</option>
                            @empty
                                <option value="">Tidak Ada Data Kategori Kamar</option>
                            @endforelse
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>
@endsection
