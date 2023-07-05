@extends('inventory.app')

@section('content')
    <div class="container">
        <h2>Ingresar producto en bodega</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('product_warehouse.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="cantidad">Cantidad:</label>
                <input type="text" name="cantidad" class="form-control" id="cantidad" required>
            </div>

            <div class="form-group">
                <label for="product_id">Producto:</label>
                <select name="product_id" class="form-control" id="product_id" required>
                    <option value="">Seleccione un producto</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="warehouse_id">Bodega:</label>
                <select name="warehouse_id" class="form-control" id="warehouse_id" required>
                    <option value="">Seleccione una bodega</option>
                    @foreach ($warehouses as $warehouse)
                        <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Add other fields as needed -->

            <button type="submit" class="btn btn-primary">Crear</button>
        </form>
    </div>
@endsection
