<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CleanLG</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Roles</h1>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>Nombre</td>
                            <td>Fecha Creaci&oacute;n</td>
                            <td>Fecha Atualizaci&oacute;n</td>
                            <td>Activo</td>
                            <td>Acciones</td>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->created_at }}</td>
                                <td>{{ $role->updated_at }}</td>
                                <td>{{ $role->status == 1 ? 'SI' : 'NO' }}</td>
                                <td>
                                    @if ($role->name != 'ADMINSTRADOR_DE_SISTEMA')
                                        <form action="{{ route('roles.changeStatus', [$role->id]) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            @if ($role->status == 1)
                                                <button type="submit" class="btn btn-danger">Desactivar</button>
                                            @else
                                                <button type="submit" class="btn btn-success">Activar</button>
                                            @endif
                                        </form>
                                    @endif

                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
        </script>
</body>

</html>
