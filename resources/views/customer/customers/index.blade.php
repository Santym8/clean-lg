@extends('app2')

@section('content')
    <div class="container">
        @if (session('success'))
            <h6 class="alert alert-success">{{ session('success') }}</h6>
        @endif
        @if (Gate::allows('action-allowed-to-user', ['CUSTOMERS/CREATE']))
            <form action="{{ route('customers.create') }}" method="GET">
                <button type="submit" class="btn btn-success" style="font-weight: bold; width:100px; font-size: 17px">Crear</button>
            </form>
        @endif
        <table class="table" id='customer-table'>
            <thead class="thead-dark">
                <tr>
                    {{-- <th scope="col">#</th> --}}
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Identificación</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Email</th>
                    {{-- <th scope="col">Status</th> --}}
                    <th scope="col">Creación</th>
                    <th scope="col">Actualizacición</th>
                    <th scope="col">Trabajo</th>
                    <th class="acciones">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        {{-- <th scope="row">{{ $customer->id }}</th> --}}
                        <td>{{ $customer->first_name }}</td>
                        <td>{{ $customer->last_name }}</td>
                        <td>{{ $customer->identification }}</td>
                        <td>{{ $customer->phone_number }}</td>
                        <td>{{ $customer->address }}</td>
                        {{-- <td>{{ $customer->status == 1 ? 'SI' : 'NO' }}</td> --}}
                        <td>{{ $customer->created_at }}</td>
                        <td>{{ $customer->updated_at }}</td>
                        <td>{{ $customer->job->name }}

                        </td>

                        <td>
                            @if (Gate::allows('action-allowed-to-user', ['CUSTOMERS/EDIT']))
                                <a href="{{ route('customers.edit', ['customer' => $customer->id]) }}"
                                    class="btn btn-primary">Editar</a>
                            @endif

                            @if (Gate::allows('action-allowed-to-user', ['CUSTOMERS/DESTROY']))
                                <button type="button" class="btn btn-danger mt-2" data-bs-toggle="modal"
                                    data-bs-target="#modal{{ $customer->id }}">Eliminar</button>

                                <!-- Modal -->
                                <div class="modal fade" id="modal{{ $customer->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Eliminar cliente</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Está seguro de que desea eliminar el cliente
                                                <strong>{{ $customer->name }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No,
                                                    cancelar</button>
                                                <form
                                                    action="{{ route('customers.destroy', ['customer' => $customer->id]) }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">Sí, eliminar
                                                        cliente</button>
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
            $('#customer-table').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                },
                responsive: true,
            });
        });
    </script>
@endpush
