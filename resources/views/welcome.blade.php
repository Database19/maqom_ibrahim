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
            background-color: #7c7c7c;
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container-fluid {
            padding: 0 15px;
        }
        .text-center svg {
            max-width: 100%;
            height: auto;
        }
        .btn-outline-warning {
            color: #ffc107;
            border-color: #ffc107;
        }
        .btn-outline-warning:hover {
            color: #fff;
            background-color: #ffc107;
            border-color: #ffc107;
        }
        @media (max-width: 768px) {
            .col-md-11, .col-md-1 {
                flex: 0 0 100%;
                max-width: 100%;
            }
            .d-flex {
                justify-content: center !important;
            }
        }
        .login-container {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
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
    {{-- <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-12 col-md-11">
                <div class="text-center">
                    <svg width="100%" height="100%" viewBox="0 0 327 70" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                        <g transform="matrix(1,0,0,1,-2472.07,-842.013)">
                            <g transform="matrix(1,0,0,1,-0.333333,0)">
                                <g transform="matrix(1,0,0,1,0,534.029)">
                                    <g transform="matrix(1,0,0,1,2099.1,-277.382)">
                                        <g transform="matrix(62.7674,0,0,62.7674,703.039,640.947)">
                                        </g>
                                        <text x="456.677px" y="640.947px" style="font-family:'Exo2-SemiBold', 'Exo 2';font-weight:600;font-size:62.767px;fill:white;">M<tspan x="525.658px 578.069px 633.304px 663.37px " y="640.947px 640.947px 640.947px 640.947px ">AQIB</tspan></text>
                                    </g>
                                    <g transform="matrix(0.879753,0,0,0.879753,1187.15,-202.45)">
                                        <path d="M1460.92,617.932C1460.92,617.932 1460.92,594.844 1460.92,594.841C1460.92,593.744 1461.48,592.705 1462.43,592.104L1480.52,580.7C1481.03,580.374 1481.63,580.201 1482.24,580.201L1510.16,580.201C1510.77,580.201 1511.37,580.374 1511.88,580.7L1529.97,592.104C1530.92,592.705 1531.48,593.744 1531.48,594.841C1531.48,594.844 1531.48,617.932 1531.48,617.932L1531.48,641.024C1531.48,641.988 1531.05,642.902 1530.3,643.517L1512.22,658.476C1511.64,658.952 1510.92,659.218 1510.16,659.218L1482.24,659.218C1481.48,659.218 1480.76,658.952 1480.18,658.476L1462.1,643.517C1461.35,642.902 1460.92,641.988 1460.92,641.024L1460.92,617.932ZM1469.66,595.195C1469.66,595.195 1475.27,599.83 1475.28,599.837L1483.41,606.563L1508.99,606.563C1508.99,606.563 1517.14,599.824 1517.15,599.817L1522.74,595.195L1509.22,586.673L1483.18,586.673L1469.66,595.195ZM1513.39,649.105L1525.01,639.501L1525.01,617.932C1525.01,613.635 1524.32,610.251 1522.95,607.974C1522.38,607.011 1521.68,606.289 1520.86,605.895C1516.39,613.928 1513.39,624.101 1513.39,632.891L1513.39,649.105ZM1506.92,652.746L1506.92,632.891C1506.92,624.713 1502.63,617.535 1496.2,613.524C1489.77,617.535 1485.48,624.713 1485.48,632.891L1485.48,652.746L1506.92,652.746ZM1467.39,617.932L1467.39,639.501L1479.01,649.105L1479.01,632.891C1479.01,624.101 1476.01,613.928 1471.54,605.895C1470.72,606.289 1470.02,607.011 1469.44,607.974C1468.09,610.251 1467.39,613.635 1467.39,617.932Z" style="fill:url(#_Linear1);"/>
                                    </g>
                                </g>
                            </g>
                        </g>
                        <defs>
                            <linearGradient id="_Linear1" x1="0" y1="0" x2="1" y2="0" gradientUnits="userSpaceOnUse" gradientTransform="matrix(3.98773e-15,65.1246,-65.1246,3.98773e-15,1496.2,594.094)"><stop offset="0" style="stop-color:rgb(201,162,94);stop-opacity:1"/><stop offset="0.59" style="stop-color:rgb(194,153,81);stop-opacity:1"/><stop offset="0.81" style="stop-color:rgb(178,132,52);stop-opacity:1"/><stop offset="1" style="stop-color:rgb(162,111,23);stop-opacity:1"/></linearGradient>
                        </defs>
                    </svg>
                </div>
            </div>
        </div>
    </div> --}}

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
</body>
</html>
