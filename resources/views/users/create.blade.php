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

        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            @method('POST')
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Nombre"
                value="{{ old('name') }}">

            <label for="last_name">Apellido</label>
            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Apellido"
                value="{{ old('last_name') }}">

            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Email"
                value="{{ old('email') }}">

            <label for="password">Contrase&#241;a</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Contrasena"
                value="{{ old('password') }}">

            <label for="identification_type">Tipo Identificaci&oacute;n</label>
            <select name="identification_type" id="identification_type" class="form-control"
                value="{{ old('identification_type') }}">
                <option value="CEDULA">C&eacute;dula de Ciudadan&iacute;a</option>
                <option value="PASAPORTE">Pasaporte</option>
            </select>

            <label for="identification">Identificaci&oacute;n</label>
            <input type="text" name="identification" id="identification" class="form-control"
                placeholder="Identificaci&oacute;n" value="{{ old('identification') }}">

            <label for="phone_number">N&uacute;mero de Tel&eacute;fono</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control"
                placeholder="N&uacute;mero de Tel&eacute;fono" value="{{ old('phone_number') }}">


            <label for="available_roles">Roles Disponibles</label>
            <select name="available_roles[]" id="available_roles" multiple class="form-control">
                @foreach ($available_roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>


            <div class="col-md-2 d-flex align-items-center">
                <div class="text-center">
                    <button type="button" id="add_role" class="btn btn-primary">&gt;</button>
                    <br><br>
                    <button type="button" id="remove_role" class="btn btn-primary">&lt;</button>
                </div>
            </div>

            <label for="available_roles">Roles Asignados</label>
            <select name="selected_roles[]" id="selected_roles" multiple class="form-control">

            </select>


            <input type="submit" class="btn btn-primary" value="Guardar" />


        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var addButton = document.getElementById('add_role');
            var removeButton = document.getElementById('remove_role');
            var availableItemsList = document.getElementById('available_roles');
            var selectedItemsList = document.getElementById('selected_roles');

            addButton.addEventListener('click', function() {
                moveSelectedItems(availableItemsList, selectedItemsList);
            });

            removeButton.addEventListener('click', function() {
                moveSelectedItems(selectedItemsList, availableItemsList);
            });

            function moveSelectedItems(sourceList, destinationList) {
                var selectedOptions = Array.from(sourceList.selectedOptions);

                selectedOptions.forEach(function(option) {
                    destinationList.appendChild(option);
                });
            }
        });
    </script>


</body>

</html>
