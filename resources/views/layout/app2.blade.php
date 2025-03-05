<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" href="{{ asset('users/images/ro.png') }}" type="image/ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pensioner Solution BAF RO</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="preload" hr ef="https://fonts.gstatic.com/s/poppins/v21/pxiEyp8kv8JHgFVrJJfecg.woff2" as="font"
        type="font/woff2" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="{{asset('users/css/fontawesome.min.css')}}" type="text/css"> --}}
    <link href="{{ asset('css/progress.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('users/css/style.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('users/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('users/css/registration.css') }}">
    <link rel="stylesheet" href="{{ asset('users/css/login.css') }}">
    {{-- from /css --}}
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}" type="text/css" />
    <link href="{{ asset('css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/toastify.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/toastify-js.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('js/config.js') }}"></script>

    <style>
        font-face {
            font-family: 'Poppins';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url('https://fonts.gstatic.com/s/poppins/v21/pxiEyp8kv8JHgFVrJJfecg.woff2') format('woff2');
        }

        body {
            font-family: 'Poppins', 'Helvetica Neue', Arial, sans-serif;
        }

        .navbar-imgs {
            width: 21rem;
        }

        #preloader {
            position: fixed;
            width: 100%;
            height: 100%;
            background: #fff;
            /* Change based on your theme */
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #pre-status {
            text-align: center;
        }

        .preload-placeholder {
            width: 80px;
            height: 80px;
            border: 5px solid #ccc;
            border-top-color: #007bff;
            /* Change to your primary color */
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

</head>

<body>
    @include('layout.partials.nav_home')
    <!-- Preloader -->
    <div id="preloader">
        <div id="pre-status">
            <div class="preload-placeholder"></div>
        </div>
    </div>

    <div id="loader" class="LoadingOverlay d-none">
        <div class="Line-Progress">
            <div class="indeterminate"></div>
        </div>
    </div>

    <div>
        @yield('content')
    </div>
    @include('layout.partials.footer_home')
    <script></script>

    {{-- <script src="js/sb-admin-2.min.js"></script> --}}

    <script type="text/javascript" src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('users/js/fontawesome.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.js') }}"></script>

    <Script>
        /*scroll window  javascript*/
        $(window).scroll(function() {
            if ($(window).scrollTop() >= 50) {
                $('nav').css('background', 'white');
                $('nav').css('opacity', '90%');
                $('nav').css('margin-top', '0px');
                $('.nav-link').css('color', '#2196F3');
                $('.dropdown-item').css('color', '#2196F3');
                $('.nav-link').css('font-weight', 'bold');
                $('.dropdown-item').css('font-weight', 'bold');
                $('.navbar-toggler-icon').css('Background', '#000');
                $('.navbar-imgs').css('width', '16rem');

            } else {
                $('nav').css('background', 'rgb(38 38 39 / 29%)');
                $('nav').css('margin-top', '0px');
                $('nav').css('opacity', '70%');
                $('.nav-link').css('color', 'white');
                $('.dropdown-item').css('color', 'white');
                $('.nav-link').css('font-weight', 'bold');
                $('.dropdown-item').css('font-weight', 'bold');
                $('.navbar-imgs').css('width', '21rem');
            }
        });

        /* ==============================================
        Preloader
        =============================================== */

        (function() {
            $(window).on('load', function() {
                $('#pre-status').fadeOut();
                $('#preloader').delay(350).fadeOut('slow');
            });
        })();
    </Script>

</body>

</html>
