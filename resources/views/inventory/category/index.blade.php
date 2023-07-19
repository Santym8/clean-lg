@extends('app')

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
        <form action="{{ route('category.create') }}" method="GET">
            <button type="submit" class="btn btn-primary">Crear</button>
        </form>
        <table id="category-table" class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Creado en</th>
                    <th scope="col">Actualizado en</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>
                            @if ($category->status == 1)
                                Activo
                            @else
                                Inactivo
                            @endif
                        </td>
                </td>
                <td>{{ $category->created_at }}</td>
                <td>{{ $category->updated_at }}</td>

                <td>
                    <a href="{{ route('category.edit', ['category' => $category->id]) }}" class="btn btn-primary">Editar</a>
                    @if ($category->status == 1)
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#modal{{ $category->id }}">Eliminar</button>
                    @else
                        <form action="{{ route('category.changeStatus', ['id' => $category->id]) }}" method="post">
                            @method('PUT')
                            @csrf
                            <button type="submit" class="btn btn-success">Restaurar</button>
                        </form>
                    @endif

                    <!-- Modal -->
                    <div class="modal fade" id="modal{{ $category->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar categoría</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ¿Está seguro de que desea eliminar la categoría
                                    <strong>{{ $category->name }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No,
                                        cancelar</button>
                                    <form action="{{ route('category.changeStatus', ['id' => $category->id]) }}"
                                        method="POST">
                                        @method('PUT')
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Sí, eliminar
                                            categoría</button>
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
            $('#category-table').DataTable({
                // Configuración personalizada de DataTables
            });
        });
    </script>
@endpush
