<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lavandería Gabrielito</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <!-- Style Sheets -->
    @stack('styles')
    @include('auth.includes.styles')
    <link href="{{ asset('assets/auth/css/dataTable.css') }}" rel="stylesheet">
</head>

<body class="navbar-fixed sidebar-fixed" id="body">

    <!-- ====================================
    ——— WRAPPER
    ===================================== -->
    <div class="wrapper">

        <!-- ====================================
          ——— LEFT SIDEBAR WITH OUT FOOTER
        ===================================== -->
        <aside class="left-sidebar sidebar-dark" id="left-sidebar">
            <div id="sidebar" class="sidebar sidebar-with-footer">
                <!-- Aplication Brand -->
                <div class="app-brand">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('assets/auth/images/logoLG.png') }}" alt="Mono">
                    </a>
                </div>
                <!-- begin sidebar scrollbar -->
                <div class="sidebar-left" data-simplebar style="height: 100%;">
                    <!-- sidebar menu -->

                    <ul class="nav sidebar-inner" id="sidebar-menu">
                        @php
                            use App\Models\security\Module;
                            $modules = Module::all();
                        @endphp

                        @foreach ($modules as $module)
                            @if (Gate::allows('has-access-to-at-least-one-action-module', [$module->name]))
                                <li class="has-sub">
                                    <a class="sidenav-item-link" href="" data-toggle="collapse"
                                        data-target="#{{ $module->name }}" aria-expanded="false"
                                        aria-controls="{{ $module->name }}">
                                        <i class="{{ $module->icon_name }}"></i>
                                        <span class="nav-text">{{ $module->menu_text }}</span> <b class="caret"></b>
                                    </a>
                                    <ul class="collapse" id="{{ $module->name }}" data-parent="#sidebar-menu">
                                        <div class="sub-menu">

                                            @foreach ($module->moduleActions as $moduleAction)
                                                @if ($moduleAction->displayable_menu == 1 && Gate::allows('action-allowed-to-user', [$moduleAction->name]))
                                                    <li>
                                                        <a class="sidenav-item-link"
                                                            href="{{ route($moduleAction->route) }}">
                                                            <i class="{{ $moduleAction->icon_name }}"></i>
                                                            <span
                                                                class="nav-text">{{ $moduleAction->menu_text }}</span>
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach

                                        </div>
                                    </ul>
                                </li>
                            @endif
                        @endforeach

                    </ul>

                </div>
            </div>
        </aside>


        <!-- ====================================
      ——— PAGE WRAPPER
      ===================================== -->
        <div class="page-wrapper">

            <!-- Header -->
            <header class="main-header" id="header">
                <nav class="navbar navbar-expand-lg navbar-light" id="navbar">

                    <span class="page-title"
                        style="margin-left: 20px">{{ ucfirst(str_replace('_', ' ', explode('.', Route::currentRouteName())[0])) }}</span>


                    <div class="navbar-right ">

                        <ul class="nav navbar-nav">

                            <!-- User Account -->
                            <li class="dropdown user-menu">
                                <button class="dropdown-toggle nav-link" data-toggle="dropdown">
                                    <span class="d-none d-lg-inline-block">{{ auth()->user()->name }}
                                        {{ auth()->user()->last_name }}</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-link-item">
                                        <a class="dropdown-link-item" href="{{ route('user_profile.index') }}"> <i
                                                class="mdi mdi-account-box-outline"></i> Actualizar Perfil </a>
                                    </li>
                                    <li class="dropdown-link-item">
                                        <a class="dropdown-link-item" href="{{ route('user_profile.editPassword') }}">
                                            <i class="mdi mdi-shield"></i> Cambiar Contraseña </a>
                                    </li>
                                    <li class="dropdown-link-item">
                                        <a class="dropdown-link-item" href="{{ route('logout') }}"> <i
                                                class="mdi mdi-logout"></i> Cerrar Sesión </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>

            </header>

            <!-- ====================================
        ——— CONTENT WRAPPER
        ===================================== -->
            @yield('content')

            <!-- Footer -->
            <footer class="footer mt-auto">

            </footer>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>
    @include('auth.includes.scripts')
    @stack('scripts')

</body>

</html>
