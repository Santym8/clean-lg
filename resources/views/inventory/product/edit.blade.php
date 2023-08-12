@extends('app2')

@section('content')
    <div class="container">
        <h4>Editar Producto</h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('product.update', $product->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}"
                    required>
                <label for="category">Categoria:</label>
                <select name="category" id="category" class="form-control" required>
                    @foreach ($categories as $category)
                        @if ($category->status == 1)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a class="btn btn-secondary" href="{{ route('product.index') }}">Cancelar</a>
        </form>
    </div>

@endsection
