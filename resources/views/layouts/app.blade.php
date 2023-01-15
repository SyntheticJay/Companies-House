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
                        {{-- <div class="navbar-content">
                            <button class="btn btn-action" type="button" onclick="halfmoon.toggleSidebar()">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                                <span class="sr-only">Toggle sidebar</span>
                            </button>
                        </div> --}}
                    @endif
                    <a href="{{ route('home') }}" class="ml-2 navbar-brand">
                        Companies House
                    </a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{ route('search') }}" class="nav-link @if (Route::is('search')) active @endif">Search</a>
                        </li>
                    </ul>
                    <div class="d-none d-md-flex ml-auto mr-2">
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
                        <div class="sidebar-menu">
                            <a href="#" class="sidebar-link sidebar-link-with-icon @if (Route::is('company')) active @endif">
                                <span class="sidebar-icon">
                                    <i class="fa fa-home fa-fw"></i>
                                </span>
                                <span class="sidebar-text">{{ $company->get('company_name') }}</span>
                            </a>
                            <div class="sidebar-divider"></div>
                            <a href="{{ route('company.officers', $company->get('company_number')) }}" class="sidebar-link sidebar-link-with-icon @if (Route::is('company.officers')) active @endif">
                                <span class="sidebar-icon">
                                    <i class="fa fa-user-tie fa-fw"></i>
                                </span>
                                <span class="sidebar-text">Officers</span>
                            </a>
                            <a href="#" class="sidebar-link sidebar-link-with-icon">
                                <span class="sidebar-icon">
                                    <i class="fa fa-history fa-fw"></i>
                                </span>
                                <span class="sidebar-text">Filing History</span>
                            </a>
                            <a href="{{ route('company.previous-names', $company->get('company_number')) }}" class="sidebar-link sidebar-link-with-icon @if (Route::is('company.previous-names')) active @endif">
                                <span class="sidebar-icon">
                                    <i class="fa fa-signature fa-fw"></i>
                                </span>
                                <span class="sidebar-text">Previous Names</span>
                            </a>
                            <a href="#" class="sidebar-link sidebar-link-with-icon">
                                <span class="sidebar-icon">
                                    <i class="fa fa-credit-card fa-fw"></i>
                                </span>
                                <span class="sidebar-text">Accounts</span>
                            </a>
                        </div>
                    </div>
                @endif
            @endauth
            <main class="content-wrapper">
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
