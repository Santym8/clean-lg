@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Auditor&iacute;a</h1>
                <table id="audit-table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Identificaci&oacute;n Usuario</th>
                            <th>Usuario</th>
                            <th>Ip</th>
                            <th>Tipo</th>
                            <th>Fecha</th>
                            <th>Informaci&oacute;n Adicional</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($audits as $audit)
                            <tr>
                                <td>{{ $audit->user ? $audit->user->identification : '-' }}</td>
                                <td>{{ $audit->user ? $audit->user->name : '-' }}
                                    {{ $audit->user ? $audit->user->name : '-' }}
                                </td>
                                <td>{{ $audit->ip }}</td>
                                <td>{{ $audit->type }}</td>
                                <td>
                                    {{ $audit->created_at }}
                                </td>
                                <td>{{ $audit->data ? $audit->data : '-' }}</td>
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
            $('#audit-table').DataTable({
                // Configuración personalizada de DataTables
            });
        });
    </script>
@endpush