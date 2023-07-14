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

    <form action="{{ route('service_orders.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="delivery_date">Fecha de entrega:</label>
            <input type="date" class="form-control" id="delivery_date" name="delivery_date" placeholder="Fecha de entrega" required>

            <label for="prepayment">Pago por adelantado:</label>
            <input type="number" class="form-control" id="prepayment" name="prepayment" placeholder="Pago por adelantado" required>

            <label for="customers">Cliente:</label>
            <select name="customers" id="customers" class="form-control" required>
                @foreach ($customers as $customer)
                @if ($customer->status == 1)
                <option value="{{ $customer->id }}">{{ $customer->first_name }}</option>
                @endif
                @endforeach
            </select>

            <label for="users">Usuario:</label>
            <select name="users" id="users" class="form-control" required>
                @foreach ($users as $user)
                @if ($user->status == 1)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endif
                @endforeach
            </select>
        </div>
        <!-- Add other fields as needed -->
        <button type="submit" class="btn btn-primary">Crear</button>
        <a class="btn btn-secondary" href="{{ route('service_orders.index') }}">Cancelar</a>
    </form>
</div>

@endsection