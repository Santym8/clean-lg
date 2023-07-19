@extends('app')

@section('content')
    <div class="container">
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
        <table class="table" id='job-table'>

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
                        <td>{{ $job->status == 1 ? 'SI' : 'NO' }}</td>
                        <td>{{ $job->created_at }}</td>
                        <td>{{ $job->updated_at }}</td>

                        <td>
                            @if (Gate::allows('action-allowed-to-user', ['JOBS/EDIT']))
                                <a href="{{ route('job.edit', ['job' => $job->id]) }}" class="btn btn-primary">Editar</a>
                            @endif

                            @if (Gate::allows('action-allowed-to-user', ['JOBS/DESTROY']))
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modal{{ $job->id }}">Eliminar</button>

                                <!-- Modal -->
                                <div class="modal fade" id="modal{{ $job->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Eliminar trabajo</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Está seguro de que desea eliminar el trabajo
                                                <strong>{{ $job->name }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No,
                                                    cancelar</button>
                                                <form action="{{ route('job.destroy', ['job' => $job->id]) }}"
                                                    method="POST">
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
@push('styles')
    <link href="//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
@endpush
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#job-table').DataTable({
                // Configuración personalizada de DataTables
            });
        });
    </script>
@endpush
