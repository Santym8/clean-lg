@extends('app')

@section('content')
<div class="container">
    @if (session('success'))
    <h6 class="alert alert-success">{{ session('success') }}</h6>

    @endif
    @if (Gate::allows('action-allowed-to-user', ['SERVICE_ORDERS_GOODS/CREATE']))
    <form action="{{ route('service_orders_goods.create') }}" method="GET">
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
    @endif
    <table class="table" id='services-table'>

        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Fecha de entrega</th>
                <th scope="col">Pago por adelantado</th>
                <th scope="col">Entregado</th>
                <th scope="col">Status</th>
                <th scope="col">Cliente</th>
                <th scope="col">Usuario</th>
                <th scope="col">Created At</th>
                <th scope="col">Updated At</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($service_order_goods as $service_order_good)
            <tr>
                <th scope="row">{{ $service_order_good->id }}</th>
                <td>{{ $service_order_good->delivery_date }}</td>
                <td>{{ $service_order_good->prepayment }}</td>
                <td>{{ $service_order_good->delivery ==1?'SI':'NO'}}</td>
                <td>{{ $service_order_good->status ==1?'SI':'NO'}}</td>
                <td>{{ $service_order_good->customers->first_name }}</td>
                <td>{{ $service_order_good->users->name }}</td>
                <td>{{ $service_order_good->created_at }}</td>
                <td>{{ $service_order_good->updated_at }}</td>
                <td>
                    @if (Gate::allows('action-allowed-to-user', ['SERVICE_ORDERS_GOODS/SHOW']))
                    <a href="{{ route('service_orders_goods.show', $service_order_good->id) }}" class="btn btn-primary">Ver</a>
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
            $('#services-table').DataTable({
                // Configuración personalizada de DataTables
            });
        });
    </script>
@endpush