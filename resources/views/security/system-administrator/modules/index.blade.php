@extends('app')

@section('content')
    <div class="container">
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @error('color')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        @if (session('success'))
            <h6 class="alert alert-success">{{ session('success') }}</h6>
        @endif

        <table class="table" id="modules-table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nombre</th>
                    <th>Texto menu</th>
                    <th>Icono</th>
                    <th>Color</th>
                    <th scope="col">Fecha Creaci&oacute;n</th>
                    <th scope="col">Fecha Actulizaci&oacute;n</th>
                    <th scope="col">Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($modules as $module)
                    <tr>
                        <td>{{ $module->name }}</td>
                        <td>{{ $module->menu_text }}</td>
                        <td style="text-align: center">
                            <i class="{{ $module->icon_name }}"></i>
                        </td>
                        <td style="background-color: {{ $module->color }}; color:white; text-align: center;">
                            {{ $module->color }}
                        </td>
                        <td>{{ $module->created_at }}</td>
                        <td>{{ $module->updated_at }}</td>
                        <td>{{ $module->status == 1 ? 'SI' : 'NO' }}</td>
                        <td>
                            @if ($module->name != 'SECURITY' && Gate::allows('action-allowed-to-user', ['MODULE/CHANGE-STATUS']))
                                <form action="{{ route('modules.changeStatus', [$module->id]) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    @if ($module->status == 1)
                                        <button type="submit" class="btn btn-danger">Desactivar</button>
                                    @else
                                        <button type="submit" class="btn btn-success">Activar</button>
                                    @endif
                                </form>
                            @endif

                            @if (Gate::allows('action-allowed-to-user', ['MODULE/EDIT']))
                                <form action="{{ route('modules.edit', [$module->id]) }}">
                                    @csrf
                                    <input type="submit" class="btn btn-primary" value="Editar">
                                </form>
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
            $('#modules-table').DataTable({
                // Configuración personalizada de DataTables
            });
        });
    </script>
@endpush
