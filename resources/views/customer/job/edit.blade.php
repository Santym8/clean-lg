@extends('app2')

@section('content')
<div class="container">
    <h4>Editar Trabajo</h4>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('job.update', $job->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $job->name }}" required>

            <label for="status"> Estado: </label>
            <select name="status" id="status" class="form-control">
                <option value="1" {{ $job->status == 1 ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ $job->status == 0 ? 'selected' : '' }}>Inactivo</option>
            </select>

        </div>
        

        <!-- Add other fields as needed -->
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a class="btn btn-secondary" href="{{ route('job.index') }}">Cancelar</a>
    </form>
</div>

@endsection