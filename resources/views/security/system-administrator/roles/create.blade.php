@extends('app2')
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
                <h1>Crear Rol</h1>
                <a class="btn btn-success" href="{{ route('roles.index') }}">Volver</a>
            </div>
        </div>

        <form id="role-form" action="{{ route('roles.store') }}" method="POST">
            @csrf
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Nombre">

            <br>
            <div class="row">
                <div class="col-md-5 .d-inline-flex">
                    <label for="available_module_actions">Acciones Disponibles</label>
                    <select style="height: 300px;" name="available_module_actions[]" id="available_module_actions" multiple
                        class="form-control">
                        @foreach ($available_module_actions as $module_action)
                            <option value="{{ $module_action->id }}">{{ $module_action->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-1 d-flex align-items-center">
                    <div class="text-center">
                        <button type="button" id="add_action" class="btn btn-primary">&gt;</button>
                        <br><br>
                        <button type="button" id="remove_action" class="btn btn-primary">&lt;</button>
                    </div>
                </div>

                <div class="col-md-5 .d-inline-flex">
                    <label for="selected_module_actions">Acciones Asignadas</label>
                    <select style="height: 300px;" name="selected_module_actions[]" id="selected_module_actions" multiple
                        class="form-control">
                    </select>
                </div>

            </div>

            <br>
            <input id="submit" type="submit" class="btn btn-primary" value="Guardar" />


        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var addButton = document.getElementById('add_action');
            var removeButton = document.getElementById('remove_action');
            var availableItemsList = document.getElementById('available_module_actions');
            var selectedItemsList = document.getElementById('selected_module_actions');
            var submitButton = document.getElementById('submit');

            submitButton.addEventListener('click', function() {
                Array.from(selectedItemsList.options).forEach(function(option) {
                    option.selected = true;
                });
            });

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
