@extends('app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Bien(es) y Orden(es) de Servicio</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('service_orders_goods.store') }}">
                        @csrf
                        <hr>
                        <h5 class="col-md-12 col-form-label text-md-left">Orden(es) de Servicio</h5>

                        <div class="service-orders-container">
                            <div class="service-order form-inline">
                                <div class="form-group">
                                    <label for="delivery_date" class="mr-2">Fecha de Entrega:</label>
                                    <input type="text" class="form-control mr-2" name="delivery_date" value="{{ $service_order_goods->delivery_date }} " disabled>
                                </div>

                                <div class="form-group">
                                    <label for="prepayment" class="mr-2">Pago por Adelantado:</label>
                                    <input type="number" step="0.01" class="form-control mr-2" name="prepayment" value="{{ $service_order_goods->prepayment }}" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="identification" class="mr-2">Cliente:</label>
                                    <input id="identification" type="text" class="form-control mr-2" name="identification" value="{{$service_order_goods->customers->identification }} " readonly>
                                </div>

                                <div class="form-group">
                                    <label for="first_name" class="mr-2">Nombre:</label>
                                    <input type="text" class="form-control mr-2" name="first_name" value="{{$service_order_goods->customers->first_name }} {{$service_order_goods->customers->last_name }}" disabled>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <h5 class="col-md-12 col-form-label text-md-left">Bienes</h5>



                        @foreach ($goods as $good)
                        <div class="service-orders-container">
                            <div class="service-order form-inline">
                                <div class="form-group">
                                    <label for="description" class="mr-2">Descripción:</label>
                                    <input id="description" type="text" class="form-control mr-2" name="description[]" value=" {{$good->description}} ">
                                </div>
                                <div class="form-group">
                                    <label for="service" class="mr-2">Servicio:</label>
                                    <input type="text" class="form-control mr-2" name="service_name[]" value="{{$good->services->name }}">
                                    <input type="hidden" name="service_id[]" value="{{ $good->services->id }}">
                                </div>

                                <div class="form-group">
                                    <label for="cost" class="mr-2">Costo:</label>
                                    <input id="cost[]" type="number" step="0.01" class="form-control mr-2" name="cost[]" value="{{ $good->services->cost }}" disabled>
                                </div>
                                <!-- Mostrar otros detalles de los bienes -->
                            </div>
                        </div>
                        @endforeach

                        <hr>
                        
                    </form>
                  
                    <div style="float: right;">
                            <h3>Subtotal: {{ $totalCost }}</h3>
                        </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-12">
                            <a class="btn btn-primary" href="{{ route('service_orders_goods.index') }}">Volver</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



@endsection