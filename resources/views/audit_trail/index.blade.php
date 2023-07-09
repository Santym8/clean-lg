@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Auditor&iacute;a</h1>
                <table class="table table-bordered">
                    <thead>
                        <tr>
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
                                <td>{{ $audit->user ? $audit->user->identification : '-' }}</td>
                                <td>{{ $audit->user ? $audit->user->name : '-' }}
                                    {{ $audit->user ? $audit->user->name : '-' }}
                                </td>
                                <td>{{ $audit->type }}</td>
                                <td>
                                    <input type="datetime" readonly value="{{ $audit->created_at }}">
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
