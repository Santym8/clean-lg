@extends('app')

@section('content')
    <div class="container">
        <h2>Editar movimiento de producto</h2>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('product_movement.update', ['id' => $movement->id]) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="cantidad">Cantidad:</label>
                <input type="number" name="quantity" class="form-control" id="cantidad" value="{{ $movement->quantity }}"
                    required>
            </div>

            <div class="form-group">
                <label for="product_warehouse_id">Producto y Bodega:</label>
                <select name="product_warehouse_id" class="form-control" id="product_warehouse_id" required>
                    <option value="">Seleccione un producto y bodega</option>
                    @foreach ($productWarehouses as $productWarehouse)
                        @if ($productWarehouse->status == 1)
                            <option value="{{ $productWarehouse->id }}"
                                {{ $movement->product_warehouse_id == $productWarehouse->id ? 'selected' : '' }}>
                                {{ $productWarehouse->product->name }} - {{ $productWarehouse->warehouse->name }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="incoming">Tipo de movimiento:</label>
                <label>
                    @if ($movement->incoming == 1)
                        Entrada
                    @else
                        Salida
                    @endif
                </label>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
            <a class="btn btn-secondary" href="{{ route('product_warehouse.index') }}">Cancelar</a>
        </form>
    </div>
@endsection
