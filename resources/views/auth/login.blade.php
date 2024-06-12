@extends('layouts.guest')

@section('content')
    <div class="col-lg-8" style="margin: auto; padding-top: 50px;">
        <style>
            .fade-out {
                animation: fadeOut 3s forwards;
            }

            @keyframes fadeOut {
                from { opacity: 1; }
                to { opacity: 0; }
            }

            .alert-sticky {
                position: fixed;
                top: 10px;
                left: 50%;
                transform: translateX(-50%);
                z-index: 1050;
                width: 80%;
                max-width: 600px;
            }
        </style>

        @if(session('success'))
            <div class="alert alert-success alert-sticky" role="alert" id="successAlert">
                <strong>{{ session('success') }}</strong>
            </div>
            <script>
                setTimeout(function() {
                    document.querySelector('#successAlert').classList.add('fade-out');
                }, 3000);
            </script>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-sticky" role="alert" id="errorAlert">
                <strong>{{ session('error') }}</strong>
            </div>
            <script>
                setTimeout(function() {
                    document.querySelector('#errorAlert').classList.add('fade-out');
                }, 3000);
            </script>
        @endif
        <div class="card-group d-block d-md-flex row">
            <div class="card col-md-7 p-4 mb-0" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                <div class="card-body">
                    <h1 style="font-weight: bold; color: #333;">{{ __('Login') }}</h1>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="input-group mb-3" style="border-radius: 10px;">
                            <span class="input-group-text" style="background-color: #eee;">
                                <svg class="icon">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-envelope-open') }}"></use>
                                </svg>
                            </span>
                            <input class="form-control @error('email') is-invalid @enderror" type="text" name="email"
                                   placeholder="{{ __('Email') }}" required autofocus style="border: none;">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="input-group mb-4" style="border-radius: 10px;">
                            <span class="input-group-text" style="background-color: #eee;">
                                <svg class="icon">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-lock-locked') }}"></use>
                                </svg>
                            </span>
                            <input class="form-control @error('password') is-invalid @enderror" type="password"
                                   name="password"
                                   placeholder="{{ __('Password') }}" required style="border: none;">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-primary px-4" type="submit" style="border-radius: 5px;">{{ __('Login') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card col-md-5 text-white bg-info py-5" style="border-radius: 15px;">
                <div class="card-body text-center">
                    <div>
                        <h2>{{ __('Buku Tamu') }}</h2>
                        <form action="{{ route('buku-tamu') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="nama_lengkap" class="form-label">{{ __('Nama Lengkap') }}</label>
                                <input type="text" class="form-control form-control-sm" name="nama_lengkap" placeholder="{{ __('Nama Lengkap') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="no_telp" class="form-label">{{ __('No HP') }}</label>
                                <input type="text" class="form-control form-control-sm" name="no_telp" placeholder="{{ __('No HP') }}" required>
                            </div>
                            <button type="submit" class="btn btn-sm btn-outline-light mt-3" style="border-radius: 5px;">{{ __('Daftar') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
