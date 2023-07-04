<!DOCTYPE html>
<html>
<head>
    <title>Editar Trabajo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Editar Trabajo</h1>
        
        <form method="POST" action="{{ route('jobs.update', $job->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $job->name }}" required>
            </div>
            <div class="form-group">
                <label for="status">Estado:</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Activo" {{ $job->status == 'Activo' ? 'selected' : '' }}>Activo</option>
                    <option value="Inactivo" {{ $job->status == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a class="btn btn-secondary" href="{{ route('jobs.index') }}">Cancelar</a>
        </form>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>