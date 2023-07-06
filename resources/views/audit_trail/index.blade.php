@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Auditor&iacute;a</h1>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Acciones</th>
                            <th>Identificaci&oacute;n Usuario</th>
                            <th>Usuario</th>
                            <th>Tipo</th>
                            <th>Fecha</th>
                            <th>Informaci&oacute;n Adicional</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($audits as $audit)
                            <tr>
                                <td>
                                    <a href="{{ route('audit_trails.show', $audit->id) }}" class="btn btn-xs btn-default">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                                <td>{{ $audit->user->identification }}</td>
                                <td>{{ $audit->user->name }} {{ $audit->user->last_name }}</td>
                                <td>{{ $audit->type }}</td>
                                <td>{{ $audit->created_at }}</td>
                                <td>{{ $audit->data ? $audit->data : '-'}}</td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
