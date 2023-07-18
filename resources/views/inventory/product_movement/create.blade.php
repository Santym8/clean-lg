@extends('app')

@section('content')
    <div class="container">
        <h2>Ingresar producto en bodega</h2>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('product_movement.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="cantidad">Cantidad:</label>
                <input type="number" name="quantity" class="form-control" id="cantidad" required>
            </div>

            <div class="form-group">
                <label for="product_warehouse_id">Producto y Bodega:</label>
                <select name="product_warehouse_id" class="form-control" id="product_warehouse_id" required>
                    <option value="">Seleccione un producto y bodega</option>
                    @foreach ($productWarehouses as $productWarehouse)
                        @if ($productWarehouse->status == 1)
                            <option value="{{ $productWarehouse->id }}">{{ $productWarehouse->product->name }} - {{ $productWarehouse->warehouse->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="incoming">Tipo de movimiento:</label>
                <select name="incoming" class="form-control" id="incoming" required>
                    <option value="1">Entrada</option>
                    <option value="0">Salida</option>
                </select>
            </div>

            <div class="form-group">
                <label for="status">Estado:</label>
                <select name="status" class="form-control" id="status" required>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
            </div>

            <!-- Add other fields as needed -->

            <button type="submit" class="btn btn-primary">Realizar Movimiento</button>
            <a class="btn btn-secondary" href="{{ route('product_warehouse.index') }}">Cancelar</a>
        </form>
    </div>
@endsection
