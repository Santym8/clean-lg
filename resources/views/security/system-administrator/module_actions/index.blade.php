@extends('app')

@section('content')
    <div class="container">
        <table class="table">

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
                    <th scope="col">Nombre</th>
                    <th>Ruta</th>
                    <th>Menu</th>
                    <th>Icono</th>
                    <th>Modulo</th>
                    <th scope="col">Fecha Creaci&oacute;n</th>
                    <th scope="col">Fecha Actulizaci&oacute;n</th>
                    <th scope="col">Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($moduleActions as $moduleAction)
                    <tr>
                        <td>{{ $moduleAction->name }}</td>
                        <td>{{ $moduleAction->route }}</td>
                        <td>{{ $moduleAction->menu }}</td>
                        <td>{{ $moduleAction->icon_name }}</td>
                        <td>{{ $moduleAction->module->name }}</td>
                        <td>{{ $moduleAction->created_at }}</td>
                        <td>{{ $moduleAction->updated_at }}</td>
                        <td>{{ $moduleAction->status == 1 ? 'SI' : 'NO' }}</td>
                        <td>
                            <form action="{{ route('module_actions.changeStatus', [$moduleAction->id]) }}" method="post">
                                @csrf
                                @method('PUT')
                                @if ($moduleAction->status == 1)
                                    <button type="submit" class="btn btn-danger">Desactivar</button>
                                @else
                                    <button type="submit" class="btn btn-success">Activar</button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
