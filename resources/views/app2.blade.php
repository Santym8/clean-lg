<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lavandería Gabrielito</title>
    <link rel="stylesheet" href="{{ asset('assets/auth/css/styles2.css') }}">

    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- Style Sheets -->
    <link href="{{ asset('assets/auth/plugins/material/css/materialdesignicons.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    {{-- <link href="//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"> --}}
</head>

<body>
    <div class="sidebar close">
        <div class="logo-details">
            <img class="cleanlg" src="{{ asset('assets/auth/images/cleanlg.png') }}" alt="LG">
            <span class="logo_name">LAVANDERIA GABRIELITO</span>
        </div>
        <!-- sidebar menu -->

        <ul class="nav-links">
            @php
                use App\Models\security\Module;
                $modules = Module::all();
            @endphp
            @foreach ($modules as $module)
                @if (Gate::allows('has-access-to-at-least-one-action-module', [$module->name]))
                    <li class="has-sub">
                        <div class="iocn-link">
                            <a href="" class="sidenav-item-link" data-toggle="collapse"
                                data-target="#{{ $module->name }}" aria-expanded="false"
                                aria-controls="{{ $module->name }}" id="module_{{ $module->id }}">
                                <i class="{{ $module->icon_name }}"></i>
                                <span class="link_name nav-text">{{ $module->menu_text }}</span>
                            </a>

                            <i class='bx bxs-chevron-down arrow'></i>
                        </div>
                        <ul class="sub-menu" id="{{ $module->name }}" data-parent="#sidebar-menu">
                            {{-- <li>
                                <a href="" class="sidenav-item-link" data-toggle="collapse"
                                    data-target="#{{ $module->name }}" aria-expanded="false"
                                    aria-controls="{{ $module->name }}" id="module_{{ $module->id }}">
                                    <i class="{{ $module->icon_name }}"></i>
                                    <span class="link_name nav-text">{{ $module->menu_text }}</span>
                                </a>
                            </li> --}}
                            @foreach ($module->moduleActions as $moduleAction)
                                @if ($moduleAction->displayable_menu == 1 && Gate::allows('action-allowed-to-user', [$moduleAction->name]))
                                    <li>
                                        <a class="sidenav-item-link" href="{{ route($moduleAction->route) }}">
                                            <i class="{{ $moduleAction->icon_name }}"></i>
                                            <span class="nav-text">{{ $moduleAction->menu_text }}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @endif
            @endforeach
            <li>
                <div class="profile-details">
                    <div class="profile-content">
                        <span>CLEAN LG</span>
                    </div>
                </div>
            </li>
        </ul>

    </div>

    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text" style="margin-left: 60px">
                @php
                    $currentRouteName = Route::currentRouteName();
                    $textToShow = ucfirst(str_replace('_', ' ', explode('.', $currentRouteName)[0]));
                    if ($textToShow === 'Customers') {
                        $textToShow = 'CLIENTES';
                    } elseif ($textToShow === 'Job') {
                        $textToShow = 'TRABAJOS';
                    } elseif ($textToShow === 'Discounts') {
                        $textToShow = 'DESCUENTOS';
                    } elseif ($textToShow === 'Warehouse') {
                        $textToShow = 'BODEGAS';
                    } elseif ($textToShow === 'Product') {
                        $textToShow = 'PRODUCTOS';
                    } elseif ($textToShow === 'Product warehouse') {
                        $textToShow = 'PRODUCTOS EN BODEGA';
                    } elseif ($textToShow === 'Product movement') {
                        $textToShow = 'MOVIMIENTOS DE PRODUCTOS';
                    } elseif ($textToShow === 'Category') {
                        $textToShow = 'CATEGORIAS';
                    } elseif ($textToShow === 'Audit trails') {
                        $textToShow = 'AUDITORIAS';
                    } elseif ($textToShow === 'Goods') {
                        $textToShow = 'BIENES';
                    } elseif ($textToShow === 'Services') {
                        $textToShow = 'SERVICIOS';
                    } elseif ($textToShow === 'Service orders') {
                        $textToShow = 'ORDENES DE SERVICIO';
                    } elseif ($textToShow === 'Service orders goods') {
                        $textToShow = 'ORDENES DE SERVICIO BIENES';
                    }
                @endphp
                {{ $textToShow }}
            </span>

            <div class="log">
                <div class="btn-group">
                    <button class="btn btn-secondary btn-lg dropdown-toggle" type="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span>{{ auth()->user()->name }} {{ auth()->user()->last_name }}</span>
                    </button>
                    <div class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('user_profile.index') }}">
                                <i class="mdi mdi-account-box-outline"></i>
                                <span>Actualizar Perfil</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('user_profile.editPassword') }}">
                                <i class="mdi mdi-shield"></i>
                                <span>Cambiar Contraseña</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}">
                                <i class="mdi mdi-logout"></i>
                                <span>Cerrar Sesión</span>
                            </a>
                        </li>
                    </div>
                </div>
            </div>
        </div>
        <div class="home-content-view">
            @yield('content')
        </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // let arrow = document.querySelectorAll(".arrow");
            // for (var i = 0; i < arrow.length; i++) {
            //     arrow[i].addEventListener("click", (e) => {
            //         let arrowParent = e.target.parentElement.parentElement;
            //         arrowParent.classList.toggle("showMenu");
            //     });
            // }

            let moduleLinks = document.querySelectorAll(".has-sub");
            moduleLinks.forEach((moduleLink) => {
                moduleLink.addEventListener("click", (e) => {
                    let moduleParent = e.target.closest(".has-sub");
                    moduleParent.classList.toggle("showMenu");
                });
            });

            let sidebar = document.querySelector(".sidebar");
            let sidebarBtn = document.querySelector(".bx-menu");
            sidebarBtn.addEventListener("click", () => {
                sidebar.classList.toggle("close");
            });

        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    @include('auth.includes.scripts')
    @stack('scripts')
</body>

</html>
