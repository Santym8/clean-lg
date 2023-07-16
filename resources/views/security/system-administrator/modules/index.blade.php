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
                    <th>Texto menu</th>
                    <th>Icono</th>
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
                        <td>{{ $module->icon_name }}</td>
                        <td>{{ $module->created_at }}</td>
                        <td>{{ $module->updated_at }}</td>
                        <td>{{ $module->status == 1 ? 'SI' : 'NO' }}</td>
                        <td>
                            <form action="{{ route('modules.changeStatus', [$module->id]) }}" method="post">
                                @csrf
                                @method('PUT')
                                @if ($module->status == 1)
                                    <button type="submit" class="btn btn-danger">Desactivar</button>
                                @else
                                    <button type="submit" class="btn btn-success">Activar</button>
                                @endif
                            </form>

                            <form action="{{ route('modules.edit', [$module->id]) }}">
                                @csrf
                                <input type="submit" class="btn btn-primary" value="Editar">
                            </form>

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
