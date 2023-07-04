<!DOCTYPE html>
<html>
<head>
    <title>Detalles del trabajo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Detalles del trabajo</h1>
        
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Detalles del trabajo</h5>
                
                <p class="card-text"><strong>ID:</strong> {{ $job->id }}</p>
                <p class="card-text"><strong>Nombre:</strong> {{ $job->name }}</p>
                <p class="card-text"><strong>Fecha de creación:</strong> {{ $job->created_at }}</p>
                <p class="card-text"><strong>Fecha de actualización:</strong> {{ $job->updated_at }}</p>
                <p class="card-text"><strong>Estado:</strong> {{ $job->status }}</p>
                
                <a class="btn btn-primary" href="{{ route('jobs.index') }}">Volver a la lista</a>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>