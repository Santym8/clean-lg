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



        @if (Gate::allows('action-allowed-to-user', ['ROLE/CREATE']))
            <form action="{{ route('roles.create') }}" method="GET">
                <button type="submit" class="btn btn-success" style="font-weight: bold; width:100px; font-size: 17px">Crear</button>
            </form>
        @endif

        <table class="table" id="roles-table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Status</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->created_at }}</td>
                        <td>{{ $role->updated_at }}</td>
                        <td>{{ $role->status == 1 ? 'SI' : 'NO' }}</td>
                        <td>
                            @if ($role->name != 'ADMINSTRADOR_DE_SISTEMA' && Gate::allows('action-allowed-to-user', ['ROLE/CHANGE-STATUS']))
                                <form action="{{ route('roles.changeStatus', [$role->id]) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    @if ($role->status == 1)
                                        <button type="submit" class="btn btn-danger">Desactivar</button>
                                    @else
                                        <button type="submit" class="btn btn-success">Activar</button>
                                    @endif
                                </form>
                            @endif

                            @if ($role->name != 'ADMINSTRADOR_DE_SISTEMA' && Gate::allows('action-allowed-to-user', ['ROLE/EDIT']))
                                <form action="{{ route('roles.edit', [$role->id]) }}">
                                    @csrf
                                    <input type="submit" class="btn btn-primary" value="Editar">
                                </form>
                            @endif

                            @if ($role->name != 'ADMINSTRADOR_DE_SISTEMA' && Gate::allows('action-allowed-to-user', ['ROLE/DESTROY']))
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modal{{ $role->id }}">Eliminar</button>

                                <!-- Modal -->
                                <div class="modal fade" id="modal{{ $role->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Eliminar Rol
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Está seguro que desea eliminar el Rol
                                                <strong>{{ $role->name }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No,
                                                    cancelar</button>
                                                <form action="{{ route('roles.destroy', ['id' => $role->id]) }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">Sí, eliminar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
            $('#roles-table').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                },
                responsive: true,
            });
        });
    </script>
@endpush
