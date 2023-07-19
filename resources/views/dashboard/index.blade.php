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
                            {{ auth()->user()->name }} {{ auth()->user()->last_name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('user_profile.index') }}">Actualizar Perfil</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('user_profile.editPassword') }}">Cambiar
                                    Contraseña</a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-error-dashboard">
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @error('color')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        @if (session('success'))
            <h6 class="alert alert-success">{{ session('success') }}</h6>
        @endif

    </div>
    <div class="container content-container">

        <div class="module-container">
            @foreach ($modules as $module)
                <div class="module-box module-box-link" style="background-color: {{ $module->color }}">
                    <a class="module-box-link" href="{{ route($module->routeFirstDisplayableAction) }}">
                        <i class="{{ $module->icon_name }} module-icon"></i>
                        <h5 class="module-title">{{ $module->menu_text }}</h5>
                    </a>
                </div>
            @endforeach
        </div>

    </div>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

</html>
