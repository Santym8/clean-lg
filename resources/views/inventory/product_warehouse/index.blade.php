@extends('inventory.app')

@section('content')
    <div class="container">
        <table class="table">
            @if (session('success'))
                <h6 class="alert alert-success">{{ session('success') }}</h6>
            @endif
            <form action="{{ route('product_warehouse.create') }}" method="GET">
                <button type="submit" class="btn btn-primary">Crear</button>
            </form>
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Quantity</th>
                    <th scope="col">Product</th>
                    <th scope="col">Warehouse</th>
                    <th scope="col">Status</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product_warehouses as $prod_ware)
                    @if ($prod_ware->status == 1)
                        <tr>
                            <td>{{ $prod_ware->cantidad }}</td>
                            <td>{{ $prod_ware->product->name }}</td>
                            <td>{{ $prod_ware->warehouse->name }}</td>
                            <td>Activo</td>
                            <td>{{ $prod_ware->created_at }}</td>
                            <td>{{ $prod_ware->updated_at }}</td>

                            <td>
                                <a href="{{ route('product_warehouse.edit', ['product_warehouse' => $prod_ware->id]) }}"
                                    class="btn btn-primary">Editar</a>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modal{{ $prod_ware->id }}">Eliminar</button>

                                <!-- Modal -->
                                <div class="modal fade" id="modal{{ $prod_ware->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Eliminar producto en bodega
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Está seguro que desea eliminar el producto de la bodega
                                                <strong>{{ $prod_ware->warehouse->name }}</strong>?
                                                <br>
                                                Producto: <strong>{{ $prod_ware->product->name }}</strong>
                                                Id: <strong>{{ $prod_ware->product_id }}</strong>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No,
                                                    cancelar</button>
                                                <form
                                                    action="{{ route('product_warehouse.destroy', ['product_warehouse' => $prod_ware->id]) }}"
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
