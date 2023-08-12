@extends('app2')

@section('content')
<div class="container">
    <h4>Editar Servicio</h4>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('goods.update', $goods->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="description">Descripción:</label>
            <input type="text" class="form-control" id="description" name="description" value="{{ $goods->description }}" required>

            <label for="status">Estado:</label>
            <select name="status" id="status" class="form-control">
                <option value="1" {{ $goods->status == 1 ? 'selected' : '' }}>SI</option>
                <option value="0" {{ $goods->status == 0 ? 'selected' : '' }}>NO</option>
            </select>

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
        <button type="submit" class="btn btn-primary">Actualizar</button>
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