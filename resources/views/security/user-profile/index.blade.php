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
                <h1>Actualizar Perfil</h1>
                <a class="btn btn-success" href="{{ route('dashboard') }}">Volver</a>
            </div>
        </div>

        <form action="{{ route('user_profile.updateProfile') }}" method="POST">
            @csrf
            @method('PATCH')
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Nombre"
                value="{{ $user->name }}">

            <label for="last_name">Apellido</label>
            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Apellido"
                value="{{ $user->last_name }}">

            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Email"
                value="{{ $user->email }}">

            <label for="phone_number">N&uacute;mero de Tel&eacute;fono</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control"
                placeholder="N&uacute;mero de Tel&eacute;fono" value="{{ $user->phone_number }}">


            <input type="submit" class="btn btn-primary" value="Guardar" />


        </form>
    </div>

@endsection
