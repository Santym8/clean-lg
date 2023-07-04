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
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <h1>Crear Usuario</h1>
                <a class="btn btn-success" href="{{ route('users.index') }}">Volver</a>
            </div>
        </div>

        <form action="{{ route('users.update', [$user->id]) }}" method="POST">
            @csrf
            @method('PATCH')
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Nombre"
                value="{{ $user->name }}">

            <label for="last_name">Apellido</label>
            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Apellido"
                value="{{ $user->last_name }}">

            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Email"
                value="{{ $user->email }}">

            <label for="identification_type">Tipo Identificaci&oacute;n</label>
            <select name="identification_type" id="identification_type" class="form-control">
                <option value="CEDULA" {{ $user->identification_type == 'CEDULA' ? 'selected' : '' }}>C&eacute;dula de
                    Ciudadan&iacute;a</option>
                <option value="PASAPORTE" {{ $user->identification_type == 'PASAPORTE' ? 'selected' : '' }}>Pasaporte
                </option>
            </select>

            <label for="identification">Identificaci&oacute;n</label>
            <input type="text" name="identification" id="identification" class="form-control"
                placeholder="Identificaci&oacute;n" value="{{ $user->identification }}">

            <label for="phone_number">N&uacute;mero de Tel&eacute;fono</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control"
                placeholder="N&uacute;mero de Tel&eacute;fono" value="{{ $user->phone_number }}">

            <label for="status">Activado</label>
            <select name="status" id="status" class="form-control">
                <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>SI</option>
                <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>NO</option>
            </select>

            <input type="submit" class="btn btn-primary" value="Guardar" />


        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>
