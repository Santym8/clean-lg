@extends('inventory.app')

@section('content')
    <div class="container">
        <h2>Create Producto</h2>

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
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name"
                    required>
                <label for="category">Categoría:</label>
                <select name="category" id="category" class="form-control" required>
                    @foreach ($categories as $category)
                        @if ($category->status == 1)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <!-- Add other fields as needed -->
            <button type="submit" class="btn btn-primary">Crear</button>
        </form>
    </div>

@endsection
