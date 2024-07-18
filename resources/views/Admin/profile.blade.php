@extends('Admin.Layout.baselayout')
@section('title')
    My Profile
@endsection
@section('content')
    <div class="container align-items-center">
        <div class="card">
            <div class="card-header text-center">
                <h3>Data Profile</h3>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <h5>Username: {{ $admin->username }}</h5>
                    <hr> <!-- Divider -->
                    <h4>Ubah password</h4>
                    <form action="{{ route('admin.new_password') }}" method="POST">
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
                        @csrf
                        <div class="form-row d-flex">
                            <div class="form-group col-md-6">
                                <label for="password">New Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                                @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                                @error('confirm_password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
