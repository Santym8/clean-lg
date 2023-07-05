@extends('inventory.app')

@section('content')
    <div class="container">
        <h2>Editar Categoria</h2>

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
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}"
                    required>
            </div>
            <!-- Add other fields as needed -->
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>

@endsection
