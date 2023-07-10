@extends('app')

@section('content')
<div class="container">
    <h2>Create Cliente</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('customers.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Nombre" required>

            <label for="last_name">Apellido:</label>
            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Apellido" required>

            <label for="identification_type">Tipo identificacion:</label>
            <select name="identification_type" id="identification_type" class="form-control"
                value="{{ old('identification_type') }}">
                <option value="CEDULA">Cédula de Ciudadanía</option>
                <option value="PASAPORTE">Pasaporte</option>
            </select>

            <label for="identification">Identificacion:</label>
            <input type="number" class="form-control" id="identification" name="identification" placeholder="Identificacion" required>

            <label for="phone_number">Numero telefono:</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Numero telefono" required>

            <label for="address">Email:</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Email" required>


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
        <button type="submit" class="btn btn-primary">Crear</button>
        <a class="btn btn-secondary" href="{{ route('customers.index') }}">Cancelar</a>
    </form>
</div>

@endsection