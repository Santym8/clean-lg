<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lavandería Gabrielito</title>
    <link href="https://cdn.materialdesignicons.com/5.9.55/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="{{ asset('assets/auth/css/dashboard.css') }}" rel="stylesheet" />
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/auth/images/logoLG.png') }}" alt="LogoLG">
                <h4>LAVANDERÍA GABRIELITO</h4>
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-error-dashboard">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>
    <div class="container mt-4 content-container">
        <div class="module-container">
            <div class="module-box module-box-link">
                <a class="module-box-link" href="{{ route('product_warehouse.index') }}">
                    <i class="mdi mdi-package-variant module-icon"></i>
                    <h5 class="module-title">Inventario</h5>
                </a>
            </div>
            <div class="module-box module-box-link">
                <a class="module-box-link"
                    @if (Gate::allows('has-rol', [['OPERADOR_TRABAJO']])) href="{{ route('job.index') }}">  
                    @else href="{{ route('customers.index') }}"> @endif
                    <i class="mdi mdi-account-multiple module-icon"></i>
                    <h5 class="module-title">Clientes</h5>
                </a>
            </div>
            <div class="module-box module-box-link">
                <a class="module-box-link" href="{{ route('users.index') }}">
                    <i class="mdi mdi-account-lock module-icon"></i>
                    <h5 class="module-title">Usuarios</h5>
                </a>
            </div>
            <div class="module-box module-box-link">
                <a class="module-box-link" href="#">
                    <i class="mdi mdi-file-check module-icon"></i>
                    <h5 class="module-title">Ordenes de Servicio</h5>
                </a>
            </div>
            <div class="module-box module-box-link">
                <a class="module-box-link" href="#">
                    <i class="mdi mdi-receipt module-icon"></i>
                    <h5 class="module-title">Facturación</h5>
                </a>
            </div>
            <div class="module-box module-box-link">
                <a class="module-box-link" href="{{route('audit_trails.index')}}">
                    <i class="mdi mdi-eye module-icon"></i>
                    <h5 class="module-title">Auditoría</h5>
                </a>
            </div>
        </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

</html>
