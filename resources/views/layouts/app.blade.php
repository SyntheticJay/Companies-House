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
    <body class="with-custom-webkit-scrollbars with-custom-css-scrollbars" data-dm-shortcut-enabled="true" data-set-preferred-mode-onload="true">
        <div class="page-wrapper @auth with-navbar @endauth @if (isset($company)) with-sidebar @endif">
            @auth
                <nav class="navbar">
                    @if (isset($company))
                        <div class="navbar-content">
                            <button class="btn btn-action" type="button" onclick="halfmoon.toggleSidebar()">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                                <span class="sr-only">Toggle sidebar</span>
                            </button>
                        </div>
                    @endif
                    <a href="{{ route('home') }}" class="navbar-brand">
                        Companies House
                    </a>    
                    <ul class="navbar-nav divided">
                        <form class="form-inline d-none d-md-flex ml-auto" action="{{ route('company.search') }}" method="POST"> 
                            @csrf
                            <input name="company_id" type="text" class="form-control" placeholder="Search by Company ID" required="required">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </form>
                    </ul>
                    <div class="d-none d-md-flex ml-auto">
                        <li class="nav-item dropdown with-arrow">
                            <a class="nav-link" data-toggle="dropdown" id="nav-user-dropdown-toggle">
                                {{ auth()->user()->name }}
                                <i class="fa fa-angle-down ml-5" aria-hidden="true"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="nav-user-dropdown-toggle">
                                <a href="{{ route('logout') }}" class="dropdown-item">
                                    <i class="fa fa-sign-out-alt" aria-hidden="true"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </div>
                </nav>
                @if (isset($company))
                    <div class="sidebar" style="height: 95%;">
                            
                    </div>
                @endif
            @endauth
            <main class="content-wrapper d-flex align-items-center justify-content-center flex-column">
                @yield('content')
            </main>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/halfmoon@1.1.1/js/halfmoon.min.js"></script>
        @yield('scripts')
        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", () => {
                @include('layouts.partials.flash')

                halfmoon.onDOMContentLoaded();
            });
        </script>
    </body>
</html>