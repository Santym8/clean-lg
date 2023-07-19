@extends('app')

@section('content')
    <div class="container">
        <h2>Editar Descuento</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('discounts.update', $discount->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="form-group">

                <label for="percentage">Porcentaje:</label>
                <input type="number" class="form-control" id="percentage" name="percentage"
                    value="{{ $discount->percentage }}">>

                <label for="status">Status:</label>
                <select name="status" id="status" class="form-control">
                    <option value="1" {{ $discount->status == 1 ? 'selected' : '' }}>SI</option>
                    <option value="0" {{ $discount->status == 0 ? 'selected' : '' }}>NO</option>
                </select>


                <div class="form-group">
                    <label for="customers">Cliente:</label>
                    <select class="form-control" name="customers">
                        @foreach ($customer as $customer)
                            @if ($customer->status == 1)
                                <option value="{{ $customer->id }}"
                                    data-name="{{ $customer->first_name . ' ' . $customer->last_name }}"
                                    {{ $customer->id == $discount->customer_id ? 'selected' : '' }}>
                                    {{ $customer->identification }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

            </div>
            <!-- Add other fields as needed -->
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a class="btn btn-secondary" href="{{ route('discounts.index') }}">Cancelar</a>
        </form>
    </div>

@endsection
