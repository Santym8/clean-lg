@extends('app2')

@section('content')
    <div class="container">
        <h4>Crear Bodega</h4>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('warehouse.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nombre de la bodega"
                    required>
            </div>
            <button type="submit" class="btn btn-primary">Crear</button>
            <a class="btn btn-secondary " href="{{ route('warehouse.index') }}">Cancelar</a>
        </form>
    </div>

@endsection
