<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title></title>
        {{-- <link rel="preload" href="https://fonts.gstatic.com/s/poppins/v21/pxiEyp8kv8JHgFVrJJfecg.woff2" as="font" type="font/woff2" crossorigin="anonymous"> --}}
        <link rel="stylesheet" href="{{asset('users/css/style.css')}}" type="text/css" />
        <link rel="stylesheet" href="{{asset('users/css/footer.css')}}">
        <link rel="stylesheet" href="{{asset('users/css/registration.css')}}">
        <link rel="stylesheet" href="{{asset('users/CSS/table.css')}}">
        {{--from /css --}}
        <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet" />
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" type="text/css" />
        <link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}" type="text/css" />
        <link href="{{asset('css/animate.min.css')}}" rel="stylesheet" />
        <link href="{{asset('css/fontawesome.css')}}" rel="stylesheet" />
        <link href="{{asset('css/style.css')}}" rel="stylesheet" />
        <link href="{{asset('css/toastify.min.css')}}" rel="stylesheet" />
        @stack('custom-css')
        {{-- Js link --}}
        <script src="{{asset('js/bootstrap.bundle.js')}}"></script>
        <script src="{{asset('js/jquery-3.7.0.min.js')}}"></script>
        <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('js/toastify-js.js')}}"></script>
        <script src="{{asset('js/config.js')}}"></script>
        <script src="{{asset('js/axios.min.js')}}"></script>
        @stack('custom-js')
        <style>
            @media only screen and (max-width: 600px) {
                thead, tbody, th, td {
                    font-size: 10px !important;
                }
                button{
                    padding: 10px !important;
                    margin-bottom: 2px !important;
                }
                .card-body{
                    padding: 5px !important;
                }
                .col-6{
                    padding: 5px !important;
                }
            }
        </style>
</head>

<body>
    @include('layout.partials.hightlights')
@include('layout.partials.nav')
<div id="loader" class="LoadingOverlay d-none">
    <div class="Line-Progress">
        <div class="indeterminate"></div>
    </div>
    </div>
<div class="container-md container container-lg">
    @yield('content')
</div>
@include('layout.partials.footer_home')

</body>
</html>
