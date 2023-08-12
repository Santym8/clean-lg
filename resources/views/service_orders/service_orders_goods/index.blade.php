@extends('app2')

@section('content')
<div class="container">
    @if (session('success'))
    <h6 class="alert alert-success">{{ session('success') }}</h6>

    @endif
    @if (Gate::allows('action-allowed-to-user', ['SERVICE_ORDERS_GOODS/CREATE']))
    <form action="{{ route('service_orders_goods.create') }}" method="GET">
        <button type="submit" class="btn btn-success" style="font-weight: bold; width:100px; font-size: 17px">Crear</button>
    </form>
    @endif
    <table class="table" id='services-table'>

        <thead class="thead-dark">
            <tr>
                <th scope="col">Fecha de entrega</th>
                <th scope="col">Abonó</th>
                <th scope="col">Entregado</th>
                <th scope="col">Estado</th>
                <th scope="col">Cliente</th>
                <th scope="col">Usuario</th>
                <th scope="col">Creado</th>
                <th scope="col">Actualizado</th>
                <th scope="col">Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($service_order_goods as $service_order_good)
            <tr>
                <td>{{ $service_order_good->delivery_date }}</td>
                <td>{{ $service_order_good->prepayment }}</td>
                <td>{{ $service_order_good->delivery ==1?'SI':'NO'}}</td>
                <td>{{ $service_order_good->status ==1?'Activo':'Inactivo'}}</td>
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
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                },
                responsive: true,
            });
        });
    </script>
@endpush