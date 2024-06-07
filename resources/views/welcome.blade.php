<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Maqom Ibrahim</title>
    @vite('resources/sass/app.scss')
    <style>
        body {
            background-image: url({{ asset('assets/default-img/bg.png') }});
        }
    </style>
</head>
<body>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-11"></div>
            <div class="col-md-1">
                <div class="d-flex justify-content-end mb-3">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/home') }}" class="btn btn-sm btn-outline-warning me-2">Home</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-sm btn-outline-warning me-2">Login</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-sm btn-outline-warning">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
</body>
</html>
