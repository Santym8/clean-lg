@extends('app2')

@section('content')
    <div class="container">
        <h4>Editar Categoría</h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('category.update', $category->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}"
                    required>
            </div>
            
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a class="btn btn-secondary" href="{{ route('category.index') }}">Cancelar</a>
        </form>
    </div>

@endsection
