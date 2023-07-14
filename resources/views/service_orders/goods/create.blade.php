@extends('app')

@section('content')
<div class="container">
    <h2>Crear Bienes</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('goods.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" required>

            <label for="description">Descripcion:</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Descripción" required>

            <label for="cost">Costo:</label>
            <input type="number" class="form-control" id="cost" name="cost" placeholder="Costo" required>

            <label for="service_orders">Orden de servicio:</label>
            <select name="service_orders" id="service_orders" class="form-control" required>
                @foreach ($service_orders as $service_order)
                @if ($service_order->status == 1)
                <option value="{{ $service_order->id }}">{{ $service_order->delivery_date }}</option>
                @endif
                @endforeach
            </select>

            <label for="services">Servicio:</label>
            <select name="services" id="services" class="form-control" required>
                @foreach ($services as $service)
                @if ($service->status == 1)
                <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endif
                @endforeach
            </select>
        </div>
        <!-- Add other fields as needed -->
        <button type="submit" class="btn btn-primary">Crear</button>
        <a class="btn btn-secondary" href="{{ route('goods.index') }}">Cancelar</a>
    </form>
</div>

@endsection