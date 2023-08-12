@extends('app2')

@section('content')
    <div class="container">
        <h4>Crear Producto</h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('product.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese el nombre del producto"
                    required>
                <label for="inputState">Categoría:</label>
                <select name="category" id="inputState" class="form-control" required>
                    @foreach ($categories as $category)
                        @if ($category->status == 1)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
           
            <button type="submit" class="btn btn-primary">Crear</button>
            <a class="btn btn-secondary" href="{{ route('product.index') }}">Cancelar</a>
        </form>
    </div>

@endsection
