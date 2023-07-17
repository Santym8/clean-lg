@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Estadísticas</h1>
                <br>
                <table class="table table-bordered" style="text-align: center">
                    <thead>
                        <tr>
                            <th class="likert-cell bg-muy-inactivo">20%</th>
                            <th class="likert-cell bg-inactivo">40%</th>
                            <th class="likert-cell bg-moderado">60%</th>
                            <th class="likert-cell bg-activo">80%</th>
                            <th class="likert-cell bg-muy-activo">100%</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="title-actions">Muy Inactivo</td>
                            <td class="title-actions">Inactivo</td>
                            <td class="title-actions">Moderado</td>
                            <td class="title-actions">Activo</td>
                            <td class="title-actions">Muy Activo</td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <table id="user-action-table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="title-actions">Identificaci&oacute;n Usuario</th>
                            <th class="title-actions">Nombre Usuario</th>
                            <th class="title-actions">Cantidad de acciones</th>
                            <th class="title-actions">Escala de Likert</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($audits as $audit)
                            <tr>
                                <td class="level-actions">{{ $audit->identification }}</td>
                                <td class="level-actions">{{ $audit->name }} {{ $audit->last_name }}</td>
                                <td class="level-actions">{{ $audit->number_actions }}</td>
                                <td
                                    class="likert-cell
                                    @if ($likertLevelsUser[$audit->id] == 'Muy Inactivo') bg-muy-inactivo
                                    @elseif ($likertLevelsUser[$audit->id] == 'Inactivo') bg-inactivo
                                    @elseif ($likertLevelsUser[$audit->id] == 'Moderado') bg-moderado
                                    @elseif ($likertLevelsUser[$audit->id] == 'Activo') bg-activo
                                    @elseif ($likertLevelsUser[$audit->id] == 'Muy Activo') bg-muy-activo @endif
                                ">
                                    {{ $likertLevelsUser[$audit->id] }}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <link href="//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <link href="{{ asset('assets/auth/css/audit.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
@endpush
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#user-action-table').DataTable({
                // Configuración personalizada de DataTables
            });
        });
    </script>
@endpush
