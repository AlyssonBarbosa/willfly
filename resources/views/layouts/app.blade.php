<!doctype html>
<html lang="pt-BR">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Willfly Bank API" name="description" />
    <meta content="José Alysson" name="author" />

    <title> @yield('title') </title>

    @include('layouts.links')

    @yield('css')

</head>

<body data-topbar="dark" data-layout="horizontal">

    <div id="layout-wrapper">

        @include('layouts.navbar')

        <div class="page-content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>

        @include('layouts.scripts')
        @yield('scripts')
    </div>
</body>

</html>