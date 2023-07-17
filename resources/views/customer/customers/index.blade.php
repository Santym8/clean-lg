@extends('app')

@section('content')
<div class="container">
    <table class="table">
        @if (session('success'))
        <h6 class="alert alert-success">{{ session('success') }}</h6>
        @endif
        @if (Gate::allows('action-allowed-to-user', ['CUSTOMERS/CREATE']))
        <form action="{{ route('customers.create') }}" method="GET">
            <button type="submit" class="btn btn-primary">Crear</button>
        </form>
        @endif
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Tipo identificacion</th>
                <th scope="col">Identificacion</th>
                <th scope="col">Numero telefono</th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>
                <th scope="col">Created At</th>
                <th scope="col">Updated At</th>
                <th scope="col">Trabajo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
            <tr>
                <th scope="row">{{ $customer->id }}</th>
                <td>{{ $customer->first_name }}</td>
                <td>{{ $customer->last_name }}</td>
                <td>{{ $customer->identification_type }}</td>
                <td>{{ $customer->identification }}</td>
                <td>{{ $customer->phone_number }}</td>
                <td>{{ $customer->address }}</td>
                <td>{{ $customer->status ==1?'SI':'NO'}}</td>
                <td>{{ $customer->created_at }}</td>
                <td>{{ $customer->updated_at }}</td>
                <td>{{ $customer->job->name }}

                </td>

                <td>
                    @if (Gate::allows('action-allowed-to-user', ['CUSTOMERS/EDIT']))
                    <a href="{{ route('customers.edit', ['customer' => $customer->id]) }}" class="btn btn-primary">Editar</a>
                    @endif

                    @if (Gate::allows('action-allowed-to-user', ['CUSTOMERS/DESTROY']))
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal{{ $customer->id }}">Eliminar</button>

                    <!-- Modal -->
                    <div class="modal fade" id="modal{{ $customer->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar cliente</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ¿Está seguro de que desea eliminar el cliente
                                    <strong>{{ $customer->name }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No,
                                        cancelar</button>
                                    <form action="{{ route('customers.destroy', ['customer' => $customer->id]) }}" method="POST">
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
