@extends('app2')

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

        @if (Gate::allows('action-allowed-to-user', ['USER/CREATE']))
            <form action="{{ route('users.create') }}" method="GET">
                <button type="submit" class="btn btn-success" style="font-weight: bold; width:100px; font-size: 17px">Crear</button>
            </form>
        @endif

        <table class="table table-bordered" id="users-table">


            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Email</th>
                    <th scope="col">Tipo ID</th>
                    <th scope="col">Identificación</th>
                    <th scope="col"># Teléfono</th>
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
                            <ul>
                                @foreach ($user->roles as $role)
                                    <li>
                                        {{ $role->name }}
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="text-center">
                            @if (Gate::allows('action-allowed-to-user', ['USER/EDIT']))
                                <form action="{{ route('users.edit', [$user->id]) }}" method="GET">
                                    @csrf
                                    @method('GET')
                                    <button class="btn btn-primary" type="submit">Editar</button>
                                </form>
                            @endif
                            <br>
                            @if (Gate::allows('action-allowed-to-user', ['USER/RESET_PASSWORD']))
                                <form action="{{ route('users.resetPassword', [$user->id]) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-danger " type="submit">Resetear Contraseña</button>
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
            $('#users-table').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                },
                responsive: true,
            });
        });
    </script>
@endpush
