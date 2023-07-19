@extends('app')

@section('content')
<div class="container">
    <table class="table" id="serices-order-table">
        @if (session('success'))
        <h6 class="alert alert-success">{{ session('success') }}</h6>
        @endif
        @if (Gate::allows('action-allowed-to-user', ['SERVICE_ORDERS/CREATE']))
        <form action="{{ route('service_orders.create') }}" method="GET">
            <button type="submit" class="btn btn-primary">Crear</button>
        </form>
        @endif
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Fecha de entrega</th>
                <th scope="col">Pago por adelantado</th>
                <th scope="col">Entregado</th>
                <th scope="col">Status</th>
                <th scope="col">Created At</th>
                <th scope="col">Updated At</th>
                <th scope="col">Cliente</th>
                <th scope="col">Usuario</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($service_orders as $service_order)
            <tr>
                <th scope="row">{{ $service_order->id }}</th>
                <td>{{ $service_order->delivery_date }}</td>
                <td>{{ $service_order->prepayment }}</td>
                <td>{{ $service_order->delivery ==1?'SI':'NO'}}</td>
                <td>{{ $service_order->status ==1?'SI':'NO'}}</td>
                <td>{{ $service_order->created_at }}</td>
                <td>{{ $service_order->updated_at }}</td>
                <td>{{ $service_order->customers->first_name }}
                <td>{{ $service_order->users->name }}
                    
                </td>

                <td>  
                    @if (Gate::allows('action-allowed-to-user', ['SERVICE_ORDERS/EDIT']))                
                    <a href="{{ route('service_orders.edit', ['service_order' => $service_order->id]) }}" class="btn btn-primary">Editar</a>
                    @endif
                    @if (Gate::allows('action-allowed-to-user', ['SERVICE_ORDERS/DESTROY']))
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal{{ $service_order->id }}">Eliminar</button>

                    <div class="modal fade" id="modal{{ $service_order->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Orden de servicio</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ¿Está seguro de que desea eliminar la Orden de servicio
                                    <strong>{{ $service_order->name }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No,
                                        cancelar</button>
                                    <form action="{{ route('service_orders.destroy', ['service_order' => $service_order->id]) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Sí, eliminar
                                            Orden de servicio</button>
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
            $('#serices-order-table').DataTable({
                // Configuración personalizada de DataTables
            });
        });
    </script>
@endpush