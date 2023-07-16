@extends('app')
@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <h1>Actualizar Accion</h1>
                <a class="btn btn-success" href="{{ route('module_actions.index') }}">Volver</a>
            </div>
        </div>

        <form action="{{ route('module_actions.update', [$moduleAction->id]) }}" method="POST">
            @csrf
            @method('PATCH')
            <label for="icon_name">Icono</label>
            <input type="text" name="icon_name" id="icon_name" class="form-control" placeholder="Nombre Icono"
                value="{{ $moduleAction->icon_name }}">

            <input type="submit" class="btn btn-primary" value="Guardar" />
        </form>
    </div>
@endsection
