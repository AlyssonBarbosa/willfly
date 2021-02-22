<head>

    <meta charset="utf-8" />
    <title> @yield('title') </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="José Alysson" name="author" />
    <link rel="stylesheet" href="{{asset('libs/twitter-bootstrap-wizard/prettify.css') }}">

    <!-- Sweet Alert-->
    <link href="{{ asset('libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    <link href="{{ asset('css/custom.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!--  -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

</head>

<body data-topbar="dark" data-layout="horizontal">

    <div id="layout-wrapper">
        @include('layouts.navbar')

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <!-- <div class="main-content"> -->

        <div class="page-content">
            <div class="container-fluid">
                @yield('content')
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        <!-- @include('layouts.footer') -->
        <!-- </div> -->
        <!-- end main content-->

        <script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('libs/node-waves/waves.min.js') }}"></script>


        <!-- twitter-bootstrap-wizard js -->
        <script src="{{ asset('libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>

        <script src="{{ asset('libs/twitter-bootstrap-wizard/prettify.js')}}"></script>
        <!-- ecommerce-checkout init -->
        <script src="{{ asset('js/pages/ecommerce-checkout.init.js') }}"></script>

        <script src=" {{ asset('libs/datatables.net/js/jquery.dataTables.min.js') }} "></script>         

        <script src="{{ asset('js/app.js') }}"></script>

        <script src="{{ asset('js/custom.js') }}"></script>        

        <script src="{{ asset('js/cep.js') }}"></script>        

        <!-- Sweet Alerts js -->
        <script src="{{ asset('libs/sweetalert2/sweetalert2.min.js') }}"></script>

        <!-- Sweet alert init js-->
        <script src="{{ asset('js/pages/sweet-alerts.init.js') }}"></script>

        @if(session()->has('message'))
        <script>
            function message(icon, title, text) {
                Swal.fire({
                    icon: icon,
                    title: title,
                    text: text,
                })
            }
            message('success', 'Sucesso', 'Operação realizada com sucesso!');
        </script>
        @endif

        @yield('scripts')
    </div>
</body>