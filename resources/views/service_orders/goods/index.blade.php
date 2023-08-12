@extends('app2')

@section('content')
    <div class="container">
        @if (session('success'))
            <h6 class="alert alert-success">{{ session('success') }}</h6>
        @endif
        @if (Gate::allows('action-allowed-to-user', ['GOODS/CREATE']))
            <form action="{{ route('goods.create') }}" method="GET">
                <button type="submit" class="btn btn-success" style="font-weight: bold; width:100px; font-size: 17px">Crear</button>
            </form>
        @endif
        <table class="table" id="goods-table">

            <thead class="thead-dark">
                <tr>                    
                    <th scope="col">Descripción</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Creado</th>
                    <th scope="col">Actualizado</th>
                    <th scope="col">Orden de servicio</th>
                    <th scope="col">Servicio</th>
                    <th scope="col">Costo</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($goods as $good)
                    <tr>                        
                        <td>{{ $good->description }}</td>
                        <td>{{ $good->status == 1 ? 'SI' : 'NO' }}</td>
                        <td>{{ $good->created_at }}</td>
                        <td>{{ $good->updated_at }}</td>
                        <td>{{ $good->service_orders->id }}</td>
                        <td>{{ $good->services->name }}</td>
                        <td>{{ $good->cost }}</td>

                        <td>
                            @if (Gate::allows('action-allowed-to-user', ['GOODS/EDIT']))
                                <a href="{{ route('goods.edit', ['good' => $good->id]) }}"
                                    class="btn btn-primary">Editar</a>
                            @endif

                            @if (Gate::allows('action-allowed-to-user', ['GOODS/DESTROY']))
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modal{{ $good->id }}">Eliminar</button>

                                <div class="modal fade" id="modal{{ $good->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Eliminar Bien</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Está seguro de que desea eliminar el Bien
                                                <strong>{{ $good->name }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No,
                                                    cancelar</button>
                                                <form action="{{ route('goods.destroy', ['good' => $good->id]) }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">Sí, eliminar
                                                        Bien</button>
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
            $('#goods-table').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                },
                responsive: true,
            });
        });
    </script>
@endpush
