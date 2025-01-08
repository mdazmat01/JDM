<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project</title>



    <!-- Fonts and icons -->
    <script src="{{ asset('admin/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["admin/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="{{ asset('admin/fontawesome/fontawesome.min.css') }}">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}">

    <!-- Plugin -->
    <link rel="stylesheet" href="{{ asset('admin/css/plugins.css') }}">

    <!-- Kaiadmin -->
    <link rel="stylesheet" href="{{ asset('admin/css/kaiadmin.css') }}">

    <!-- Demo -->
    {{-- <link rel="stylesheet" href="{{ asset('admin/css/demo.css') }}"> --}}

    <!-- DataTable -->
    <link rel="stylesheet" href="{{ asset('admin/DataTables/datatables.min.css') }}">

    {{-- Axios --}}
    <script src="{{ asset('admin/js/axios.min.js') }}"></script>

    <!-- Toastify -->
    <link rel="stylesheet" href="{{ asset('admin/toastify/toastify.css') }}">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
</head>

<body>



    <div class="wrapper">
        <!-- Sidebar -->
        @include('components.admin.sidenav')
        <!-- End Sidebar -->

        <div class="main-panel">
            <!-- Main Header -->
            @include('components.admin.header')
            <!-- Main Header End -->

            <div class="container">
                <div class="page-inner">
                    {{-- <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                        <div>
                            <h3 class="fw-bold mb-3">Dashboard</h3>
                        </div>


                    </div> --}}
                    @include('components.admin.notification')
                    @yield('content')



                </div>
            </div>

            <!-- Footer -->
            @include('components.admin.footer')
            <!-- Footer End -->

        </div>


    </div>

    <!--   Core JS Files   -->
    <script src="{{ asset('admin/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('admin/js/core/popper.min.js') }}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('admin/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>


    <!-- DataTable -->
    <script src="{{ asset('admin/DataTables/datatables.min.js') }}"></script>

    <!-- FontAwesome -->
    <script src="{{ asset('admin/fontawesome/fontawesome.min.js') }}"></script>

    {{-- Bootstrap --}}
    <script src="{{ asset('admin/js/core/bootstrap.min.js') }}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{ asset('admin/js/kaiadmin.min.js') }}"></script>

    <!-- Toastify -->
    <script src="{{ asset('admin/toastify/toastify.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('admin/js/main.js') }}"></script>

    @stack('scripts')

</body>

</html>
