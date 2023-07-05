@extends('app')

@section('content')
    <div class="container">
        <h2>Crear Trabajo</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('job.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter job name"
                    required>
            </div>
            <!-- Add other fields as needed -->
            <button type="submit" class="btn btn-primary">Crear</button>
        </form>
    </div>

@endsection