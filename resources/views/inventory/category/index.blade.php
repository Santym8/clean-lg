@extends('app')

@section('content')
    <div class="container">
        <table class="table">

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @error('color')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            @if (session('success'))
                <h6 class="alert alert-success">{{ session('success') }}</h6>
            @endif
            <form action="{{ route('category.create') }}" method="GET">
                <button type="submit" class="btn btn-primary">Crear</button>
            </form>
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <th scope="row">{{ $category->id }}</th>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->status }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td>{{ $category->updated_at }}</td>

                        <td>
                            <a href="{{ route('category.edit', ['category' => $category->id]) }}"
                                class="btn btn-primary">Editar</a>

                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#modal{{ $category->id }}">Eliminar</button>

                            <!-- Modal -->
                            <div class="modal fade" id="modal{{ $category->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Eliminar categoría</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Está seguro de que desea eliminar la categoría
                                            <strong>{{ $category->name }}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No,
                                                cancelar</button>
                                            <form action="{{ route('category.destroy', ['category' => $category->id]) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-primary">Sí, eliminar
                                                    categoría</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
