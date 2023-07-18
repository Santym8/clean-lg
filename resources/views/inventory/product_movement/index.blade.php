@extends('app')

@section('content')
    <div class="container">
        @if (session('success'))
            <h6 class="alert alert-success">{{ session('success') }}</h6>
        @endif
        <table id="product-movement-table" class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Tipo</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Bodega</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Creado en</th>
                    <th scope="col">Actualizado en</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($movements as $prod_mov)
                    @if ($prod_mov->status == 1)
                        <tr>
                            <td>
                                @if ($prod_mov->incoming == 1)
                                    Entrada
                                @else
                                    Salida
                                @endif
                            </td>
                            <td>{{ $prod_mov->quantity }}</td>
                            <td>{{ $prod_mov->productWarehouse->warehouse->name }}</td>
                            <td>{{ $prod_mov->productWarehouse->product->name }}</td>
                            <td>
                                @if ($prod_mov->status == 1)
                                    Activo
                                @else
                                    Inactivo
                                @endif
                            </td>
                            <td>{{ $prod_mov->created_at }}</td>
                            <td>{{ $prod_mov->updated_at }}</td>

                            <td>
                                <a href="{{ route('product_movement.edit', ['id' => $prod_mov->id]) }}"
                                    class="btn btn-primary">Editar</a>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modal{{ $prod_mov->id }}">Eliminar</button>

                                <!-- Modal -->
                                <div class="modal fade" id="modal{{ $prod_mov->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Eliminar movimiento
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Está seguro que desea eliminar el movimiento de producto de la bodega
                                                <strong>{{ $prod_mov->productWarehouse->warehouse->name }}</strong>?
                                                <br>
                                                Producto: <strong>{{ $prod_mov->productWarehouse->product->name }}</strong>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No,
                                                    cancelar</button>
                                                <form
                                                    action="{{ route('product_movement.destroy', ['id' => $prod_mov->id]) }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">Sí, eliminar</button>
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
            $('#product-movement-table').DataTable({
                // Configuración personalizada de DataTables
            });
        });
    </script>
@endpush
