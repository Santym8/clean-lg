@extends('app2')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')
    <div class="container">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <h6 class="alert alert-success">{{ session('success') }}</h6>
        @endif
        @if (Gate::allows('action-allowed-to-user', ['WAREHOUSE/CREATE']))
            <form action="{{ route('warehouse.create') }}" method="GET">
                <button type="submit" class="btn btn-success" style="font-weight: bold; width:100px; font-size: 17px">Crear</button>
            </form>
        @endif
        <table id="warehouse-table" class="table">
            <thead class="">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Creado en</th>
                    <th scope="col">Actualizado en</th>
                    <th class="acciones">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($warehouses as $warehouse)
                    <tr>
                        <td>{{ $warehouse->name }}</td>
                        <td>
                            @if ($warehouse->status == 1)
                                Activo
                            @else
                                Inactivo
                            @endif
                        </td>

                        </td>
                        <td>{{ $warehouse->created_at }}</td>
                        <td>{{ $warehouse->updated_at }}</td>

                        <td>
                            @if (Gate::allows('action-allowed-to-user', ['WAREHOUSE/EDIT']))
                                <a href="{{ route('warehouse.edit', ['warehouse' => $warehouse->id]) }}"
                                    class="btn btn-primary">Editar</a>
                            @endif
                            @if (Gate::allows('action-allowed-to-user', ['WAREHOUSE/CHANGE-STATUS']))
                                @if ($warehouse->status == 1)
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#modal{{ $warehouse->id }}">Eliminar</button>
                                @else
                                    <form class="restaurar" action="{{ route('warehouse.changeStatus', ['id' => $warehouse->id]) }}"
                                        method="post">
                                        @method('PUT')
                                        @csrf
                                        <button type="submit" class="btn">Restaurar</button>
                                    </form>
                                @endif

                                <!-- Modal -->
                                <div class="modal fade" id="modal{{ $warehouse->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Eliminar bodega</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Está seguro que desea eliminar la bodega
                                                <strong>{{ $warehouse->name }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No,
                                                    cancelar</button>
                                                <form
                                                    action="{{ route('warehouse.changeStatus', ['id' => $warehouse->id]) }}"
                                                    method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">Sí, eliminar
                                                        bodega</button>
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
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#warehouse-table').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                },
            });
        });
    </script>
@endpush
