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
                <h1>Actualizar Rol</h1>
                <a class="btn btn-success" href="{{ route('roles.index') }}">Volver</a>
            </div>
        </div>

        <form action="{{ route('roles.update', [$role->id]) }}" method="POST">
            @csrf
            @method('PATCH')
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Nombre"
                value="{{ $role->name }}">



            <label for="available_module_actions">Acciones Disponibles</label>
            <select name="available_module_actions[]" id="available_module_actions" multiple class="form-control">
                @foreach ($available_module_actions as $module_action)
                    <option value="{{ $module_action->id }}">{{ $module_action->name }}</option>
                @endforeach
            </select>

            <div class="col-md-2 d-flex align-items-center">
                <div class="text-center">
                    <button type="button" id="add_action" class="btn btn-primary">&gt;</button>
                    <br><br>
                    <button type="button" id="remove_action" class="btn btn-primary">&lt;</button>
                </div>
            </div>

            <label for="selected_module_actions">Acciones Asignadas</label>
            <select name="selected_module_actions[]" id="selected_module_actions" multiple class="form-control" readonly>

                @foreach ($role->moduleActions as $module_action)
                    <option value="{{ $module_action->id }}" selected>{{ $module_action->name }}</option>
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
            var addButton = document.getElementById('add_action');
            var removeButton = document.getElementById('remove_action');
            var availableItemsList = document.getElementById('available_module_actions');
            var selectedItemsList = document.getElementById('selected_module_actions');

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
