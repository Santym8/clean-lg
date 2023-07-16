@extends('app')

@section('content')
<div class="container">
    <table class="table">
        @if (session('success'))
        <h6 class="alert alert-success">{{ session('success') }}</h6>
        @endif
        <form action="{{ route('service_orders_goods.create') }}" method="GET">
            <button type="submit" class="btn btn-primary">Crear</button>
        </form>
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
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection