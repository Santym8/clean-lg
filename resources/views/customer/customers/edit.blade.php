@extends('app')

@section('content')
    <div class="container">
        <h2>Editar Cliente</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('customers.update', $customer->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="first_name">Nombre:</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $customer->first_name }}" >
                <label for="last_name">Apellido:</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $customer->last_name }}" >
                <label for="name">Tipo identificacion:</label>
                <select name="identification_type" id="identification_type" class="form-control">
                <option value="CEDULA" {{ $customer->identification_type == 'CEDULA' ? 'selected' : '' }}>Cédula de
                    Ciudadanía</option>
                <option value="PASAPORTE" {{ $customer->identification_type == 'PASAPORTE' ? 'selected' : '' }}>Pasaporte
                </option>
                </select>
                <label for="identification">Identificacion:</label>
                <input type="text" class="form-control" id="identification" name="identification" value="{{ $customer->identification }}" >
                <label for="phone_number">Número de teléfono:</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $customer->phone_number }}" >
                <label for="address">Email:</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $customer->address }}" >
                <label for="status">Status:</label>
                <select name="status" id="status" class="form-control">
                <option value="1" {{ $customer->status == 1 ? 'selected' : '' }}>SI</option>
                <option value="0" {{ $customer->status == 0 ? 'selected' : '' }}>NO</option>
                </select>
                <label for="jobs">Trabajo:</label>
                <select name="jobs" id="jobs" class="form-control" required>
                    @foreach ($jobs as $job)
                        @if ($job->status == 1)
                            <option value="{{ $job->id }}">{{ $job->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <!-- Add other fields as needed -->
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a class="btn btn-secondary" href="{{ route('customers.index') }}">Cancelar</a>
        </form>
    </div>

@endsection