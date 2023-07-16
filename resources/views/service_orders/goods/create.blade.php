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

            <label for="description">Descripcion:</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Descripción" required>

            <label for="service_orders">Orden de servicio:</label>
            <select name="service_orders" id="service_orders" class="form-control" required>
                @foreach ($service_orders as $service_order)
                @if ($service_order->status == 1)
                <option value="{{ $service_order->id }}">{{ $service_order->id }}</option>
                @endif
                @endforeach
            </select>

            <div class="form-group">
                <label for="services" class="mr-2">Servicio:</label>
                <select class="form-control mr-2" name="services" onchange="updateCost(this)">
                <option value="" disabled selected>Seleccione el servicio</option>
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}" data-price="{{ $service->cost }}">{{ $service->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="cost" class="mr-2">Costo:</label>
                <input type="number" step="0.01" class="form-control mr-2" name="cost" readonly>
            </div>
        </div>
        <!-- Add other fields as needed -->
        <button type="submit" class="btn btn-primary">Crear</button>
        <a class="btn btn-secondary" href="{{ route('goods.index') }}">Cancelar</a>
    </form>
</div>
<script>
        function updateCost(select) {
            const container = select.parentNode.parentNode;
            const costInput = container.querySelector('input[name="cost"]');
            const price = select.options[select.selectedIndex].getAttribute('data-price');
            costInput.value = price;
        }
    </script>

@endsection