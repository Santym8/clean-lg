@extends('app')

@section('content')
<div class="container">
    <table class="table">
        @if (session('success'))
        <h6 class="alert alert-success">{{ session('success') }}</h6>
        @endif
        <form action="{{ route('goods.create') }}" method="GET">
            <button type="submit" class="btn btn-primary">Crear</button>
        </form>
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Costo</th>
                <th scope="col">Status</th>
                <th scope="col">Created At</th>
                <th scope="col">Updated At</th>
                <th scope="col">Orden de servicio</th>
                <th scope="col">Servicio</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($goods as $good)
            <tr>
                <th scope="row">{{ $good->id }}</th>
                <td>{{ $good->name }}</td>
                <td>{{ $good->description }}</td>
                <td>{{ $good->cost }}</td>
                <td>{{ $good->status ==1?'SI':'NO'}}</td>
                <td>{{ $good->created_at }}</td>
                <td>{{ $good->updated_at }}</td>
                <td>{{ $good->service_orders->delivery_date }}</td>
                <td>{{ $good->services->name }}</td>

                <td>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal{{ $good->id }}">Eliminar</button>
                    
                    <div class="modal fade" id="modal{{ $good->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Bien</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ¿Está seguro de que desea eliminar el Bien
                                    <strong>{{ $good->name }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No,
                                        cancelar</button>
                                    <form action="{{ route('goods.destroy', ['good' => $good->id]) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Sí, eliminar
                                            Bien</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection