<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title></title>

    <link rel="icon" type="image/x-icon" href="{{ asset('/favicon.ico') }}" />
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/toastify.min.css') }}" rel="stylesheet" />


    <link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css') }}"
        rel="stylesheet" />

    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>


    <script src="{{ asset('js/toastify-js.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <style>
        @media only screen and (max-width: 600px) {

            thead,
            tbody,
            th,
            td {
                font-size: 10px !important;
            }

            button {
                padding: 10px !important;
                margin-bottom: 2px !important;
            }

            .card-body {
                padding: 5px !important;
            }

            .col-6 {
                padding: 5px !important;
            }
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

    <nav class="navbar fixed-top px-0 shadow-sm bg-dark text-white">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <span class="icon-nav m-0 h5" onclick="MenuBarClickHandler()">
                    <i class="fa fa-solid fa-bars fa-1x text-white"></i>
                </span>
                {{-- <img class="nav-logo  mx-2"  src="{{asset('users/images/ro.png')}}" alt="logo"/> --}}
            </a>

            <div class="float-right h-auto d-flex">
                <div class="user-dropdown">
                    <img class="icon-nav-img" src="{{ asset('users/images/ro.png') }}" alt="" />
                    <div class="user-dropdown-content bg-dark">
                        <div class="mt-4 text-center">
                            <img class="icon-nav-img" src="{{ asset('users/images/ro.png') }}" alt="" />
                            <h6 class="text-white">User Name</h6>
                            <hr class="user-dropdown-divider  p-0" />
                        </div>
                        <a href="{{ url('/userProfile') }}" class="side-bar-item">
                            <span class="side-bar-item-caption text-white">Profile</span>
                        </a>
                        <a href="{{ url('/admin-logout') }}" class="side-bar-item">
                            <span class="side-bar-item-caption text-white">Logout</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <div id="sideNavRef" class="side-nav-open bg-dark text-white">

        <a href="{{ url('/dashboard') }}" class="side-bar-item">
            <i class="bi bi-graph-up"></i>
            <span class="side-bar-item-caption text-white">Dashboard</span>
        </a>
        <span id="adminRole">
            <a href="{{ url('/admin-users') }}" class="side-bar-item">
                <i class="bi bi-people"></i>
                <span class="side-bar-item-caption text-white">Admin Users </span>
            </a>
            <a href="{{ url('/gen-users') }}" class="side-bar-item">
                <i class="bi bi-people"></i>
                <span class="side-bar-item-caption text-white">General Users </span>
            </a>

            <a href="{{ url('/faq-list') }}" class="side-bar-item">
                <i class="bi bi-question-circle"></i>
                <span class="side-bar-item-caption text-white">FAQ </span>
            </a>

            <a href="{{ url('/notice-list') }}" class="side-bar-item">
                <i class="bi bi-journal-bookmark-fill"></i>
                <span class="side-bar-item-caption text-white">Notice </span>
            </a>
            <a href="{{ url('/form-list') }}" class="side-bar-item">
                <i class="bi bi-textarea-resize"></i>
                <span class="side-bar-item-caption text-white">Important Form </span>
            </a>

            <a href="/conversation-list" class="side-bar-item">
                <i class="bi bi-chat-dots"></i>
                <span class="side-bar-item-caption text-white">Reply-Admin Q&A</span>
            </a>
            <a href="{{ url('/job-seekers-admin') }}" class="side-bar-item">
                <i class="bi bi-people"></i>
                <span class="side-bar-item-caption text-white">Job Seekers</span>
            </a>
            <a href="{{ url('/employer-users') }}" class="side-bar-item">
                <i class="bi bi-people"></i>
                <span class="side-bar-item-caption text-white">Employers</span>
            </a>
            <a href="{{ url('/employer-circuler-list') }}" class="side-bar-item">
                <i class="bi bi-people"></i>
                <span class="side-bar-item-caption text-white">Employers Job Circuler</span>
            </a>
            <a href="{{ url('/settings') }}" class="side-bar-item">
                <i class="bi bi-gear-wide-connected"></i>
                <span class="side-bar-item-caption text-white">Home Settings</span>
            </a>
        </span>
        <span id="pensonerSection">
            <a href="{{ url('/pensioner-list') }}" class="side-bar-item">
                <i class="bi bi-people"></i>
                <span class="side-bar-item-caption text-white">Pension Processing Steps</span>
            </a>

            <a href="{{ url('/conversation-pension') }}" class="side-bar-item">
                <i class="bi bi-people"></i>
                <span class="side-bar-item-caption text-white">Reply-Pension Q&A</span>
            </a>
        </span>

        <span id="docIV">
            <a href="{{ url('/conversation-docu-IV') }}" class="side-bar-item">
                <i class="bi bi-chat-dots"></i>
                <span class="side-bar-item-caption text-white">Reply-Doc IV-V Q&A</span>
            </a>
        </span>
    </div>


    <div id="contentRef" class="content">
        @yield('content')
    </div>



    <script>
        function MenuBarClickHandler() {
            let sideNav = document.getElementById('sideNavRef');
            let content = document.getElementById('contentRef');
            if (sideNav.classList.contains("side-nav-open")) {
                sideNav.classList.add("side-nav-close");
                sideNav.classList.remove("side-nav-open");
                content.classList.add("content-expand");
                content.classList.remove("content");
            } else {
                sideNav.classList.remove("side-nav-close");
                sideNav.classList.add("side-nav-open");
                content.classList.remove("content-expand");
                content.classList.add("content");
            }
        }

        async function getRole() {
        try {
            let res = await axios.get('/role'); // Ensure the endpoint is correct
            let role = res.data; // Adjust based on response format

            // Pension Role = 2
            let pensionSection = document.getElementById('pensonerSection');
            let pensionSectionDashboard = document.getElementById('pensionDashboard');
            if (pensionSection) {
                role === '2' || role === '1' ? pensionSection.classList.remove('d-none') : pensionSection.classList.add('d-none');
            }
            if (pensionSectionDashboard) {
                role === '2' || role === '1' ? pensionSectionDashboard.classList.remove('d-none') : pensionSectionDashboard.classList.add('d-none');
            }

            // Doc-IV Role = 5
            let docIVSection = document.getElementById('docIV');
            let docIVSectionDashboard = document.getElementById('docIvDashboard');
            if (docIVSection) {
                role === '5' || role === '1' ? docIVSection.classList.remove('d-none') : docIVSection.classList.add('d-none');
            }
            if (docIVSectionDashboard) {
                role === '5' || role === '1' ? docIVSectionDashboard.classList.remove('d-none') : docIVSectionDashboard.classList.add('d-none');
            }

            // Admin Role = 1
            let adminSection = document.getElementById('adminRole');
            let adminSectionDashboard = document.getElementById('adminDashboard');
            if (adminSection) {
                role === '1' ? adminSection.classList.remove('d-none') : adminSection.classList.add('d-none');
            }
            if (adminSectionDashboard) {
                role === '1' ? adminSectionDashboard.classList.remove('d-none') : adminSectionDashboard.classList.add('d-none');
            }

        } catch (error) {
            console.error("Error fetching role:", error);
        }
    }
    (function() {
            $(window).on('load', function() {
                $('#pre-status').fadeOut();
                $('#preloader').delay(350).fadeOut('slow');
            });
        })();
    getRole(); // Fetch the role on page load

    </script>

</body>

</html>
