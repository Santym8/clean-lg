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
        @if (Gate::allows('action-allowed-to-user', ['SERVICES/CREATE']))
        <form action="{{ route('services.create') }}" method="GET">
            <button type="submit" class="btn btn-primary">Crear</button>
        </form>
        @endif
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Costo</th>
                <th scope="col">Estado</th>
                <th scope="col">Created At</th>
                <th scope="col">Updated At</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
            <tr>
                <th scope="row">{{ $service->id }}</th>
                <td>{{ $service->name }}</td>
                <td>{{ $service->cost }}</td>
                <td>{{ $service->status == 1 ? 'SI' : 'NO'  }}</td>
                <td>{{ $service->created_at }}</td>
                <td>{{ $service->updated_at }}</td>

                <td>
                    @if (Gate::allows('action-allowed-to-user', ['SERVICES/EDIT']))
                    <a href="{{ route('services.edit', ['service' => $service->id]) }}" class="btn btn-primary">Editar</a>
                    @endif
                    @if (Gate::allows('action-allowed-to-user', ['SERVICES/DESTROY']))
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal{{ $service->id }}">Eliminar</button>
                   
                    <!-- Modal -->
                    <div class="modal fade" id="modal{{ $service->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Servicio</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ¿Está seguro de que desea eliminar el servicio
                                    <strong>{{ $service->name }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No,
                                        cancelar</button>
                                    <form action="{{ route('services.destroy', ['service' => $service->id]) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Sí, eliminar
                                            servicio</button>
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