<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lavandería Gabrielito</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>
    <!-- Style Sheets -->
    @include('auth.includes.styles')
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

                        <li class="">
                            <div class="section-title-module">
                                <i class="mdi mdi-book-minus"></i>
                                <span class="nav-text">Inventario</span>
                            </div>
                        </li>

                        <li class="section-title">
                            Funciones
                        </li>

                        <li class="has-sub">
                            <a class="sidenav-item-link" href="" data-toggle="collapse" data-target="#inventory"
                                aria-expanded="false" aria-controls="inventory">
                                <i class="mdi mdi-book-open"></i>
                                <span class="nav-text">Gestión Inventario</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="inventory" data-parent="#sidebar-menu">
                                <div class="sub-menu">

                                    <li>
                                        <a class="sidenav-item-link" href="{{ route('product.index') }}">
                                            <span class="nav-text">Productos</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a class="sidenav-item-link" href="{{ route('product_warehouse.index') }}">
                                            <span class="nav-text">Productos en Bodega</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a class="sidenav-item-link" href="{{ route('category.index') }}">
                                            <span class="nav-text">Categorías de Productos</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a class="sidenav-item-link" href="{{ route('warehouse.index') }}">
                                            <span class="nav-text">Bodegas</span>
                                        </a>
                                    </li>

                                </div>
                            </ul>
                        </li>

                        <li class="">
                            <div class="section-title-module">
                                <i class="mdi mdi-account-multiple"></i>
                                <span class="nav-text">Clientes</span>
                            </div>
                        </li>

                        <li class="section-title">
                            Funciones
                        </li>

                        <li class="has-sub">
                            <a class="sidenav-item-link" href="" data-toggle="collapse" data-target="#customer"
                                aria-expanded="false" aria-controls="customer">
                                <i class="mdi mdi-book-open"></i>
                                <span class="nav-text">Gestión Clientes</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="customer" data-parent="#sidebar-menu">
                                <div class="sub-menu">

                                    <li>
                                        <a class="sidenav-item-link" href="{{ route('customers.index') }}">
                                            <span class="nav-text">Clientes</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a class="sidenav-item-link" href="{{ route('job.index') }}">
                                            <span class="nav-text">Trabajos</span>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>

                        <li class="">
                            <div class="section-title-module">
                                <i class="mdi mdi-account-key"></i>
                                <span class="nav-text">Control de Acceso</span>
                            </div>
                        </li>

                        <li class="section-title">
                            Funciones
                        </li>

                        <li class="has-sub">
                            <a class="sidenav-item-link" href="" data-toggle="collapse" data-target="#access"
                                aria-expanded="false" aria-controls="access">
                                <i class="mdi mdi-book-open"></i>
                                <span class="nav-text">Gestión Usuario</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="access" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="{{ route('users.index') }}">
                                            <span class="nav-text">Usuarios</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href="{{ route('roles.index') }}">
                                            <span class="nav-text">Roles</span>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>

                    </ul>
                </div>

                <div class="sidebar-footer">
                    <div class="sidebar-footer-content">
                        <ul class="d-flex">
                            {{-- <li>
                                <a href="user-account-settings.html" data-toggle="tooltip"
                                    title="Profile settings"><i class="mdi mdi-settings"></i></a>
                            </li>
                            <li>
                                <a href="#" data-toggle="tooltip" title="No chat messages"><i
                                        class="mdi mdi-chat-processing"></i></a>
                            </li> --}}
                        </ul>
                    </div>
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

                            <li class="custom-dropdown">
                                <button class="notify-toggler custom-dropdown-toggler">
                                    <i class="mdi mdi-bell-outline icon"></i>
                                    <span class="badge badge-xs rounded-circle">21</span>
                                </button>
                                <div class="dropdown-notify">

                                    <div class="" data-simplebar style="height: 325px;">
                                        <div class="tab-content" id="myTabContent">

                                            <div class="tab-pane fade show active" id="all" role="tabpanel"
                                                aria-labelledby="all-tabs">

                                                <div class="media media-sm bg-warning-10 p-4 mb-0">
                                                    <div class="media-sm-wrapper">
                                                        <a href="user-profile.html">
                                                            <img src="{{ asset('assets/auth/images/user/user-sm-02.jpg') }}"
                                                                alt="User Image">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <a href="user-profile.html">
                                                            <span class="title mb-0">John Doe</span>
                                                            <span class="discribe">Extremity sweetness difficult
                                                                behaviour he of. On disposal of as landlord horrible.
                                                                Afraid at highly months do things on at.</span>
                                                            <span class="time">
                                                                <time>Just now</time>...
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                    <footer class="border-top dropdown-notify-footer">
                                        <div class="d-flex justify-content-between align-items-center py-2 px-4">
                                            <span>Last updated 3 min ago</span>
                                            <a id="refress-button" href="javascript:"
                                                class="btn mdi mdi-cached btn-refress"></a>
                                        </div>
                                    </footer>
                                </div>
                            </li>
                            <!-- User Account -->
                            <li class="dropdown user-menu">
                                <button class="dropdown-toggle nav-link" data-toggle="dropdown">
                                    <img src="{{ asset('assets/auth/images/user/user-xs-01.jpg') }}"
                                        class="user-image rounded-circle" alt="User Image" />
                                    <span class="d-none d-lg-inline-block">John Doe</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a class="dropdown-link-item" href="user-profile.html">
                                            <i class="mdi mdi-account-outline"></i>
                                            <span class="nav-text">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-link-item" href="email-inbox.html">
                                            <i class="mdi mdi-email-outline"></i>
                                            <span class="nav-text">Message</span>
                                            <span class="badge badge-pill badge-primary">24</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-link-item" href="user-activities.html">
                                            <i class="mdi mdi-diamond-stone"></i>
                                            <span class="nav-text">Activitise</span></a>
                                    </li>
                                    <li>
                                        <a class="dropdown-link-item" href="user-account-settings.html">
                                            <i class="mdi mdi-settings"></i>
                                            <span class="nav-text">Account Setting</span>
                                        </a>
                                    </li>

                                    <li class="dropdown-footer">
                                        <a class="dropdown-link-item" href="sign-in.html"> <i
                                                class="mdi mdi-logout"></i> Log Out </a>
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

    @include('auth.includes.scripts')
    @yield('scripts')

</body>

</html>