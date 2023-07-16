@extends('app')

@section('content')
    <div class="container">
        <h2>Crear Servicio</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('services.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Ingresa el nombre del servicio"required>
                <label for="cost">Costo:</label>
                <input type="number" class="form-control" id="cost" name="cost" step="0.01" placeholder="Ingresa el costo del servicio"required>
            </div>
            <!-- Add other fields as needed -->
            <button type="submit" class="btn btn-primary">Crear</button>
            <a class="btn btn-secondary" href="{{ route('services.index') }}">Cancelar</a>
        </form>
    </div>

@endsection