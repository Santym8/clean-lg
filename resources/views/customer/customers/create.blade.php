@extends('app2')

@section('content')
    <div class="container">
        <h4>Crear Cliente</h4>

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

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name">Nombre:</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Nombre"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="last_name">Apellido:</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Apellido"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="identification_type">Tipo identificación:</label>
                        <select name="identification_type" id="identification_type" class="form-control" required>
                            <option value="CEDULA">Cédula de Ciudadanía</option>
                            <option value="PASAPORTE">Pasaporte</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="identification">Identificación:</label>
                        <input type="number" class="form-control" id="identification" name="identification"
                            placeholder="Identificación" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone_number">Número teléfono:</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number"
                            placeholder="Número teléfono" required>
                    </div>

                    <div class="form-group">
                        <label for="address">Correo:</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Correo"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="jobs">Trabajo:</label>
                        <select name="jobs" id="jobs" class="form-control" required>
                            @foreach ($jobs as $job)
                                @if ($job->status == 1)
                                    <option value="{{ $job->id }}">{{ $job->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Add other fields as needed -->
            <div class="form-group d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Crear</button>
                <a class="btn btn-secondary mx-2" href="{{ route('customers.index') }}">Cancelar</a>
            </div>
        </form>

    </div>

@endsection
