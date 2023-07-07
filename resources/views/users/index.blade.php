@extends('app')

@section('content')
    <div class="container">
        <table class="table table-bordered">

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @error('color')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            @if (session('success'))
                <h6 class="alert alert-success">{{ session('success') }}</h6>
            @endif

            <form action="{{ route('users.create') }}" method="GET">
                <button type="submit" class="btn btn-primary">Crear</button>
            </form>

            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Email</th>
                    <th scope="col">Tipo Identificación</th>
                    <th scope="col">Identificación</th>
                    <th scope="col">Número de Teléfono</th>
                    <th scope="col">Activo</th>
                    <th scope="col">Roles</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->identification_type }}</td>
                        <td>{{ $user->identification }}</td>
                        <td>{{ $user->phone_number }}</td>
                        <td>{{ $user->status == 1 ? 'SI' : 'NO' }}</td>
                        <td>
                            @foreach ($user->roles as $role)
                                {{ $role->name }}
                            @endforeach
                        </td>
                        <td>
                            <form action="{{ route('users.edit', [$user->id]) }}" method="GET">
                                @csrf
                                @method('GET')
                                <button class="btn btn-primary" type="submit">Editar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
