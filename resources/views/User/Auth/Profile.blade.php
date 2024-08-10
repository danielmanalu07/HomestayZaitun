@extends('User.Layout.BaseLayout')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <style>
        .img-container {
            max-width: 100%;
            max-height: 100%;
            margin-bottom: 15px;
        }

        #crop-image {
            max-width: 100%;
            max-height: 100%;
        }

        .img-thumbnail {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
        }
    </style>
@endpush

@section('content')
    <div class="container" style="padding-top: 10%;">
        <div class="row">
            <!-- Profile Section -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">{{ __('Profile') }}</div>
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
                        <form id="profile-form" method="POST" action="{{ route('user.update.profile') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="text-center mb-4">
                                <div class="position-relative d-inline-block">
                                    @if ($user->photo)
                                        <img id="profile-photo" src="{{ Storage::url($user->photo) }}" alt="Profile Photo"
                                            class="img-thumbnail rounded-circle" width="150">
                                    @else
                                        <img id="profile-photo" src="https://via.placeholder.com/150"
                                            alt="Default Profile Photo" class="img-thumbnail rounded-circle" width="150">
                                    @endif
                                    <a href="#" id="edit-photo"
                                        class="position-absolute bottom-0 end-0 translate-middle p-2 bg-light rounded-circle">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </div>
                            </div>

                            <input id="photo-input" type="file" class="d-none" accept="image/*" name="photo">
                            <input id="cropped-photo" type="hidden" name="photo">

                            <div class="mb-3 row">
                                <label for="nama_lengkap"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nama Lengkap') }}</label>
                                <div class="col-md-8">
                                    <input id="nama_lengkap" type="text"
                                        class="form-control @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap"
                                        value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required autofocus>
                                    @error('nama_lengkap')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                                <div class="col-md-8">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email" readonly
                                        value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="phone"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>
                                <div class="col-md-8">
                                    <input id="phone" type="text"
                                        class="form-control @error('phone') is-invalid @enderror" name="phone"
                                        value="{{ old('phone', $user->phone) }}" required>
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="alamat"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Alamat') }}</label>
                                <div class="col-md-8">
                                    <textarea id="alamat" class="form-control @error('alamat') is-invalid @enderror" name="alamat" required>{{ old('alamat', $user->alamat) }}</textarea>
                                    @error('alamat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="is_verified"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>
                                <div class="col-md-8">
                                    <input id="is_verified" type="text" class="form-control" name="is_verified"
                                        value="{{ $user->is_verified ? 'Aktif' : 'Nonaktif' }}" readonly>
                                </div>
                            </div>

                            <div class="mb-0 row">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                                    <button type="reset" class="btn btn-secondary">{{ __('Discard') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Change Password Section -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('Ubah Password') }}</div>
                    <div class="card-body">
                        @if (Session::has('error_password'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ Session::get('error_password') }}
                                </button>
                            </div>
                        @endif
                        @if (Session::has('success_password'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ Session::get('success_password') }}
                                </button>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('user.ubah.password') }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3 row">
                                <label for="current_password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>
                                <div class="col-md-8">
                                    <input id="current_password" type="password"
                                        class="form-control @error('current_password') is-invalid @enderror"
                                        name="current_password" required>
                                    @error('current_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="new_password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>
                                <div class="col-md-8">
                                    <input id="new_password" type="password"
                                        class="form-control @error('new_password') is-invalid @enderror"
                                        name="new_password" required>
                                    @error('new_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="new_password_confirmation"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm New Password') }}</label>
                                <div class="col-md-8">
                                    <input id="new_password_confirmation" type="password" class="form-control"
                                        name="new_password_confirmation" required>
                                </div>
                            </div>

                            <div class="mb-0 row">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">{{ __('Update Password') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="cropModal" tabindex="-1" aria-labelledby="cropModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cropModalLabel">{{ __('Crop Photo') }}</h5>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <img id="crop-image" src="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="button" id="crop-save" class="btn btn-primary">{{ __('Save') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script>
        document.getElementById('edit-photo').addEventListener('click', function() {
            document.getElementById('photo-input').click();
        });

        let cropper;
        document.getElementById('photo-input').addEventListener('change', function(event) {
            const files = event.target.files;
            if (files && files.length > 0) {
                const file = files[0];
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('crop-image').src = e.target.result;
                    const modal = new bootstrap.Modal(document.getElementById('cropModal'));
                    modal.show();
                    if (cropper) {
                        cropper.destroy();
                    }
                    cropper = new Cropper(document.getElementById('crop-image'), {
                        aspectRatio: 1,
                        viewMode: 1,
                        scalable: true,
                        zoomable: true,
                        movable: true,
                        responsive: true,
                        autoCropArea: 1,
                        minContainerWidth: 300,
                        minContainerHeight: 300
                    });
                };
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('crop-save').addEventListener('click', function() {
            const canvas = cropper.getCroppedCanvas({
                width: 500,
                height: 500,
            });
            canvas.toBlob(function(blob) {
                const url = URL.createObjectURL(blob);
                document.getElementById('profile-photo').src = url;

                // Convert blob to base64 for form submission
                const reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    const base64data = reader.result;
                    document.getElementById('cropped-photo').value = base64data;
                };

                const modal = bootstrap.Modal.getInstance(document.getElementById('cropModal'));
                modal.hide();
            });
        });
    </script>
@endpush
