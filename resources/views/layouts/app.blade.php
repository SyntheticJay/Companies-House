<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Companies House - @yield('title')</title>

        <link href="https://cdn.jsdelivr.net/npm/halfmoon@1.1.1/css/halfmoon-variables.min.css" rel="stylesheet" />

        @vite(['resources/js/app.js'])
    </head>
    <body data-set-preferred-mode-onload="true">
        <div class="page-wrapper with-navbar-fixed-bottom">
            <div class="content-wrapper">
                <div class="container d-flex justify-content-center align-items-center mt-1">
                    @include('layouts.partials.flash')
                </div>
                @yield('content')
            </div>
            <nav class="navbar navbar-fixed-bottom text-center">
                <div class="navbar-text m-auto">
                    Companies House, 2022 Jay L.
                </div>
            </nav>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/halfmoon@1.1.1/js/halfmoon.min.js"></script>
        @yield('scripts')
        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", () => halfmoon.onDOMContentLoaded());
        </script>
    </body>
</html>