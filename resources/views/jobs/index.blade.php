<!DOCTYPE html>
<html>
<head>
    <title>Lista de trabajos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Lista de trabajos</h1>
        
        <a class="btn btn-primary" href="{{ route('jobs.create') }}">Crear trabajo</a>
        
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Fecha de creación</th>
                    <th>Fecha de actualización</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jobs as $job)
                <tr>
                    <td>{{ $job->id }}</td>
                    <td>{{ $job->name }}</td>
                    <td>{{ $job->created_at }}</td>
                    <td>{{ $job->updated_at }}</td>
                    <td>{{ $job->status }}</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('jobs.show', $job->id) }}">Ver</a>
                        <a class="btn btn-primary" href="{{ route('jobs.edit', $job->id) }}">Editar</a>
                        <form method="POST" action="{{ route('jobs.destroy', $job->id) }}" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
