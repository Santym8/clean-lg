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
                <h1>Users</h1>
                <a class="btn btn-success" href="{{ route('users.create') }}">Crear Usuario</a>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Acciones</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Email</th>
                            <th>Tipo Identificaci&oacute;n</th>
                            <th>Identificaci&oacute;n</th>
                            <th>N&uacute;mero de Tel&eacute;fono</th>
                            <th>Activo</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <form action="{{ route('users.edit', [$user->id]) }}" method="GET">
                                        @csrf
                                        @method('GET')
                                        <button class="btn btn-primary" type="submit">Editar</button>
                                    </form>
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->identification_type }}</td>
                                <td>{{ $user->identification }}</td>
                                <td>{{ $user->phone_number }}</td>
                                <td>{{ $user->status == 1 ? 'SI':'NO' }}</td>


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
