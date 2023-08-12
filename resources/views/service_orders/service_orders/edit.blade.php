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

    <form action="{{ route('service_orders.update', $service_orders->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="delivery_date">Fecha de entrega:</label>
            <input type="date" class="form-control" id="delivery_date" name="delivery_date" value="{{ $service_orders->delivery_date }}" required>

            <label for="prepayment">Pago por adelantado:</label>
            <input type="number" class="form-control" id="prepayment" name="prepayment" value="{{ $service_orders->prepayment }}" required>

            <label for="delivery">Entregado:</label>
            <select name="delivery" id="delivery" class="form-control">
                <option value="1" {{ $service_orders->delivery == 1 ? 'selected' : '' }}>SI</option>
                <option value="0" {{ $service_orders->delivery == 0 ? 'selected' : '' }}>NO</option>
            </select>

            <label for="status">Estado:</label>
            <select name="status" id="status" class="form-control">
                <option value="1" {{ $service_orders->status == 1 ? 'selected' : '' }}>SI</option>
                <option value="0" {{ $service_orders->status == 0 ? 'selected' : '' }}>NO</option>
            </select>

            <label for="customers">Cliente:</label>
                <select name="customers" id="customers" class="form-control" required>
                    @foreach ($customers as $customer)
                        @if ($customer->status == 1)
                            <option value="{{ $customer->id }}">{{ $customer->identification }}</option>
                        @endif
                    @endforeach
                </select>
        </div>

        <!-- Add other fields as needed -->
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a class="btn btn-secondary" href="{{ route('service_orders.index') }}">Cancelar</a>
    </form>
</div>

@endsection