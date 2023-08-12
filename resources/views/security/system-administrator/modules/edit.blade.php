@extends('app2')
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
                <h4>Actualizar Modulo</h4>
                <a class="btn btn-success" href="{{ route('modules.index') }}">Volver</a>
            </div>
        </div>

        <form action="{{ route('modules.update', [$module->id]) }}" method="POST">
            @csrf
            @method('PATCH')
            <label for="menu_text">Texto de Menu</label>
            <input type="text" name="menu_text" id="menu_text" class="form-control" placeholder="Texto de Menu"
                value="{{ $module->menu_text }}">

            <label for="icon_name">Icono</label>
            <input type="text" name="icon_name" id="icon_name" class="form-control" placeholder="Nombre Icono"
                value="{{ $module->icon_name }}">

            <label for="color">Color</label>
            <input type="color" name="color" id="color" class="form-control" placeholder="Color"
                value="{{ $module->color }}">

            <input type="submit" class="btn btn-primary" value="Guardar" />
        </form>
    </div>
@endsection
