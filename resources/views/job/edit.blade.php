@extends('app')

@section('content')
<div class="container">
    <h2>Editar Trabajo</h2>

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

            <select name="status" id="status" class="form-control">
                <option value="1" {{ $job->status == 1 ? 'selected' : '' }}>SI</option>
                <option value="0" {{ $job->status == 0 ? 'selected' : '' }}>NO</option>
            </select>

        </div>
        <label for="status">Activado</label>

        <!-- Add other fields as needed -->
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

@endsection