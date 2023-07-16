@extends('app')

@section('content')
<div class="container">
    <h2>Editar Servicio</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('services.update', $services->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $services->name }}" required>
            <label for="cost">Costo:</label>
            <input type="number" class="form-control" id="cost" name="cost" step="0.01" value="{{ $services->cost }}" required>

            <select name="status" id="status" class="form-control">
                <option value="1" {{ $services->status == 1 ? 'selected' : '' }}>SI</option>
                <option value="0" {{ $services->status == 0 ? 'selected' : '' }}>NO</option>
            </select>

        </div>
        <label for="status">Activado</label>

        <!-- Add other fields as needed -->
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a class="btn btn-secondary" href="{{ route('services.index') }}">Cancelar</a>
    </form>
</div>

@endsection