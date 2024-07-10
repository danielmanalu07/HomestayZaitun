@extends('Admin.Layout.baselayout')
@section('title')
    Tambah Data Diskon
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
                <form action="{{ url('/admin/diskon') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="jumlah_diskon" class="form-label">Jumlah Diskon</label>
                        <span class="text-danger">*</span>
                        <input type="number" class="form-control" id="jumlah_diskon" name="jumlah_diskon"
                            placeholder="Masukkan Jumlah Diskon" required>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan Diskon</label>
                        <span class="text-danger">*</span>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required></textarea>
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
                    <button type="submit" class="btn btn-info">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>
@endsection
