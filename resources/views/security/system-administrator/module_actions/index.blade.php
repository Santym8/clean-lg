@extends('app')

@section('content')
    <div class="container">
        <table class="table" id="module-actions-table">

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @error('color')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            @if (session('success'))
                <h6 class="alert alert-success">{{ session('success') }}</h6>
            @endif

            <thead class="thead-dark">
                <tr>
                    <th>Modulo</th>
                    <th scope="col">Nombre</th>
                    <th>Ruta</th>
                    <th>Menu</th>
                    <th>Icono</th>
                    <th>Texto Menu</th>
                    <th scope="col">Fecha Creaci&oacute;n</th>
                    <th scope="col">Fecha Actulizaci&oacute;n</th>
                    <th scope="col">Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($moduleActions as $moduleAction)
                    <tr>
                        <td>{{ $moduleAction->module->name }}</td>
                        <td>{{ $moduleAction->name }}</td>
                        <td>{{ $moduleAction->route }}</td>
                        <td>{{ $moduleAction->displayable_menu == 1 ? 'SI' : 'NO' }}</td>
                        <td>{{ $moduleAction->icon_name }}</td>
                        <td> {{ $moduleAction->menu_text }}</td>
                        <td>{{ $moduleAction->created_at }}</td>
                        <td>{{ $moduleAction->updated_at }}</td>
                        <td>{{ $moduleAction->status == 1 ? 'SI' : 'NO' }}</td>
                        <td>
                            @if ($moduleAction->module->name != 'SECURITY' && Gate::allows('action-allowed-to-user', ['MODULE-ACTION/CHANGE-STATUS']))
                                <form action="{{ route('module_actions.changeStatus', [$moduleAction->id]) }}"
                                    method="post">
                                    @csrf
                                    @method('PUT')
                                    @if ($moduleAction->status == 1)
                                        <button type="submit" class="btn btn-danger">Desactivar</button>
                                    @else
                                        <button type="submit" class="btn btn-success">Activar</button>
                                    @endif
                                </form>
                            @endif


                            @if ($moduleAction->displayable_menu && Gate::allows('action-allowed-to-user', ['MODULE-ACTION/EDIT']))
                                <a href="{{ route('module_actions.edit', [$moduleAction->id]) }}"
                                    class="btn btn-primary">Editar</a>
                            @endif


                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection

@push('styles')
    <link href="//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
@endpush
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#module-actions-table').DataTable({
                // Configuración personalizada de DataTables
            });
        });
    </script>
@endpush
