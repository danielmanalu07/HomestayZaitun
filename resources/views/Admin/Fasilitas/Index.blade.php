@extends('Admin.Layout.baselayout')
@section('title')
    Data Fasilitas
@endsection
@push('css')
    <style>
        .img-thumbnail {
            max-height: 200px;
            object-fit: cover;
        }

        .card-data {
            background-color: gainsboro;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <a href="{{ url('/admin/fasilitas/create') }}" class="btn btn-sm btn-info">Tambah Data</a>
            </div>
            <div class="card-body">
                @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ Session::get('error') }}
                        </button>
                    </div>
                @endif
                <div class="row">
                    @forelse ($fasilitas as $item)
                        <div class="col-md-3 col-sm-6">
                            <div class="card card-data my-2">
                                <img src="{{ asset('gambar/fasilitas/' . $item->gambar) }}"
                                    class="card-img-top img-thumbnail" alt="image_fasilitas">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->nama }}</h5>
                                    <p class="card-text">{{ Str::limit($item->deskripsi, 40) }}</p>
                                    <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                    <a href="#" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="card bg-light my-2">
                                <h1>Tidak Ada Data</h1>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
