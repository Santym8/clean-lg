@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Estadisticas</h1>
                <br>
                <h2>Escala de Likert</h2>
                <table class="table table-bordered" style="text-align: center">
                    <thead>
                        <tr>
                            <th>20%</th>
                            <th>40%</th>
                            <th>60%</th>
                            <th>80%</th>
                            <th>100%</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Muy Inactivo</td>
                            <td>Inactivo</td>
                            <td>Moderado</td>
                            <td>Activo</td>
                            <td>Muy Activo</td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Identificaci&oacute;n Usuario</th>
                            <th>Nombre Usuario</th>
                            <th>Cantidad de acciones</th>
                            <th>Escala de Likert</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($audits as $audit)
                            <tr>
                                <td>{{ $audit->identification }}</td>
                                <td>{{ $audit->name }}
                                    {{ $audit->last_name }}
                                </td>
                                <td>{{ $audit->number_actions }}</td>
                                <td>{{ $likertLevelsUser[$audit->id] }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
