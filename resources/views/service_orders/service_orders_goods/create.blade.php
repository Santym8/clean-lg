@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Crear Bien y Orden(es) de Servicio</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('service_orders_goods.store') }}">
                            @csrf

                            <hr>

                            <h5 class="col-md-12 col-form-label text-md-left">Orden(es) de Servicio</h5>

                            <div class="service-orders-container">
                                <div class="service-order form-inline">
                                    <div class="form-group">
                                        <label for="delivery_date" class="mr-2">Fecha de Entrega:</label>
                                        <input type="date" class="form-control mr-2" name="delivery_date" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="prepayment" class="mr-2">Pago por Adelantado:</label>
                                        <input type="number" step="0.01" class="form-control mr-2" name="prepayment" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="users" class="mr-2">Usuario:</label>
                                        <select class="form-control mr-2" name="users" required>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="customers" class="mr-2">Cliente:</label>
                                        <select class="form-control mr-2" name="customers" required>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->first_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <h5 class="col-md-12 col-form-label text-md-left">Bienes</h5>

                            <div class="goods-container">
                                <div class="good form-inline">
                                    <div class="form-group">
                                        <label for="name" class="mr-2">Nombre:</label>
                                        <input id="name" type="text" class="form-control mr-2" name="name" required >
                                    </div>

                                    <div class="form-group">
                                        <label for="description" class="mr-2">Descripción:</label>
                                        <input id="description" type="text" class="form-control mr-2" name="description" required >
                                        
                                    </div>

                                    <div class="form-group">
                                        <label for="service" class="mr-2">Servicio:</label>
                                        <select class="form-control mr-2" name="services" required>
                                            @foreach ($services as $service)
                                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="cost" class="mr-2">Costo:</label>
                                        <input type="number" step="0.01" class="form-control mr-2" name="cost" required>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <button type="button" class="btn btn-primary" onclick="addGood()">Agregar</button>

                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Crear</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addGood() {
            const container = document.querySelector('.goods-container');
            const good = document.querySelector('.good');
            const clone = good.cloneNode(true);
            container.appendChild(clone);
        }
    </script>
@endsection
