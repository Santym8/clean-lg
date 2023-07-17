@extends('app')
<script src="{{ asset('js/goods.js') }}"></script>
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
                                        <input type="date" class="form-control mr-2" name="delivery_date" >
                                    </div>

                                    <div class="form-group">
                                    <label for="prepayment" class="mr-2">Pago por Adelantado:</label>
                                    <input type="number" step="0.01" class="form-control mr-2" name="prepayment" value="0" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="customer_id" class="mr-2">Cliente:</label>
                                        <select class="form-control mr-2" name="customer_id" onchange="updateCustomerName(this)">
                                            <option value="" disabled selected>Seleccione el cliente</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}" data-name="{{ $customer->first_name }} {{ $customer->last_name }}">{{ $customer->identification }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="mr-2">Nombres:</label>
                                        <input id="name" type="text" class="form-control mr-2" name="name" readonly>
                                    </div>

                                   
                                </div>
                            </div>
                            <hr>
                            <h5 class="col-md-12 col-form-label text-md-left">Bienes</h5>

                            <div id="bienes-container">
                                <div class="good form-inline">

                                    <div class="form-group">
                                        <label for="description" class="mr-2">Descripción:</label>
                                        <input id="description" type="text" class="form-control mr-2" name="description[]"  >                                    
                                    </div>

                                    <div class="form-group">
                                        <label for="service" class="mr-2">Servicio:</label>
                                        <select class="form-control mr-2" name="service_id[]" onchange="updateCost(this)">
                                            <option value="" disabled selected>Seleccione el servicio</option>
                                            @foreach ($services as $service)
                                                <option value="{{ $service->id }}" data-price="{{ $service->cost }}">{{ $service->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="cost" class="mr-2">Costo:</label>
                                        <input id="cost" type="number" step="0.01" class="form-control mr-2" name="cost" >
                                    </div>

                                  
                                </div>
                            </div>
                            <hr>

                              <!-- Campos para los bienes -->


                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                            <button type="button" id="agregar-bien">Agregar Bien</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addGood() {
            const container = document.querySelector('.goods-container');
            const good = container.querySelector('.good');
            const clone = good.cloneNode(true);

            // Limpiar los campos del nuevo bien clonado
            const fields = clone.querySelectorAll('input, select');
            fields.forEach(field => {field.value = '';});
            container.appendChild(clone);
        }

        function removeGood(button) {
            const container = document.querySelector('.goods-container');
            const good = button.parentNode;
            if (container.childElementCount > 1) {
                container.removeChild(good);
            }
        }

        function updateCost(select) {
            const container = select.parentNode.parentNode;
            const costInput = container.querySelector('input[name="cost"]');
            const price = select.options[select.selectedIndex].getAttribute('data-price');
            costInput.value = price;
        }

       function updateCustomerName(select) {
            const container = select.parentNode.parentNode;
            const nameInput = container.querySelector('input[name="name"]');
            const customerName = select.options[select.selectedIndex].getAttribute('data-name');
            nameInput.value = customerName;
        }
    </script>

    @if($errors->any())
        <div class="alert alert-danger">
            <h6>Por favor corregir los siguientes errores:</h6>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li> 
                @endforeach
            </ul>
        </div>
    @endif
@endsection
