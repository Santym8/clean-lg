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

        @if (Gate::allows('action-allowed-to-user', ['JOBS/CREATE']))
        <form action="{{ route('job.create') }}" method="GET">
            <button type="submit" class="btn btn-primary">Crear</button>
        </form>
        @endif

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
            @foreach ($job as $job)
            <tr>
                <th scope="row">{{ $job->id }}</th>
                <td>{{ $job->name }}</td>
                <td>{{ $job->status == 1 ? 'SI' : 'NO'  }}</td>
                <td>{{ $job->created_at }}</td>
                <td>{{ $job->updated_at }}</td>

                <td>
                    @if (Gate::allows('action-allowed-to-user', ['JOBS/EDIT']))
                    <a href="{{ route('job.edit', ['job' => $job->id]) }}" class="btn btn-primary">Editar</a>
                    @endif

                    @if (Gate::allows('action-allowed-to-user', ['JOBS/DESTROY']))
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal{{ $job->id }}">Eliminar</button>

                    <!-- Modal -->
                    <div class="modal fade" id="modal{{ $job->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar trabajo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ¿Está seguro de que desea eliminar el trabajo
                                    <strong>{{ $job->name }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No,
                                        cancelar</button>
                                    <form action="{{ route('job.destroy', ['job' => $job->id]) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Sí, eliminar
                                            trabajo</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
