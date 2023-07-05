@extends('inventory.app')

@section('content')
    <div class="container">
        <table class="table">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <h6 class="alert alert-success">{{ session('success') }}</h6>
            @endif
            <form action="{{ route('warehouse.create') }}" method="GET">
                <button type="submit" class="btn btn-primary">Crear</button>
            </form>
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($warehouses as $warehouse)
                    @if ($warehouse->status == 1)
                        <tr>
                            <td>{{ $warehouse->name }}</td>
                            <td>Activo</td>
                            <td>{{ $warehouse->created_at }}</td>
                            <td>{{ $warehouse->updated_at }}</td>

                            <td>
                                <a href="{{ route('warehouse.edit', ['warehouse' => $warehouse->id]) }}"
                                    class="btn btn-primary">Editar</a>

                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modal{{ $warehouse->id }}">Delete</button>

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
                                                    action="{{ route('warehouse.destroy', ['warehouse' => $warehouse->id]) }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">Sí, eliminar
                                                        bodega</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
