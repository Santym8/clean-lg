@extends('app')

@section('content')
<div class="container">
    <h2>Crear Descuento</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('discounts.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="percentage">Porcentaje:</label>
            <input type="number" class="form-control" id="percentage" name="percentage" placeholder="Porcentaje" required>

            <div class="form-group">
                <label for="customers" class="mr-2">Cliente:</label>
                <select class="form-control mr-2" name="customers" onchange="updateCustomerName(this)">
                <option value="" disabled selected>Seleccione el cliente</option>
                    @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}" data-name="{{ $customer->first_name }} {{ $customer->last_name }}">{{ $customer->identification }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="name" class="mr-2">Nombres:</label>
                <input id="name" type="text" class="form-control mr-2" name="name" readonly>
            </div>
        </div>
        <!-- Add other fields as needed -->
        <button type="submit" class="btn btn-primary">Crear</button>
        <a class="btn btn-secondary" href="{{ route('discounts.index') }}">Cancelar</a>
    </form>
</div>

<script>
    function updateCustomerName(select) {
            const container = select.parentNode.parentNode;
            const nameInput = container.querySelector('input[name="name"]');
            const customerName = select.options[select.selectedIndex].getAttribute('data-name');
            nameInput.value = customerName;
        }
</script>

@endsection
