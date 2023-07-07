@extends('app')
@section('content')
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
                <h1>Actualizar Usuario</h1>
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

            <label for="selected_roles">Roles Asignados</label>
            <select name="selected_roles[]" id="selected_roles" multiple class="form-control" readonly>
                @foreach ($user->roles as $role)
                    <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                @endforeach
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
@endsection
