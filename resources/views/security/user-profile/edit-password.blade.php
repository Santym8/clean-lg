@extends('app')
@section('content')
    <div class="container">
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @error('color')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        @if (session('success'))
            <h6 class="alert alert-success">{{ session('success') }}</h6>
        @endif

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
                <h1>Cambiar Contraseña</h1>
                <a class="btn btn-success" href="{{ route('dashboard') }}">Volver</a>
            </div>
        </div>

        <form action="{{ route('user_profile.updatePassword') }}" method="POST">
            @csrf
            @method('PATCH')



            <label for="email">Contraseña Actual</label>
            <input type="password" name="current_password" id="current_password" class="form-control"
                placeholder="Contraseña Actual">

            <label for="email">Nueva Contraseña</label>
            <input type="password" name="new_password" id="new_password" class="form-control"
                placeholder="Nueva Contraseña">

            <label for="email">Repetir Contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                placeholder="Repetir Contraseña">



            <input type="submit" class="btn btn-primary" value="Guardar" />


        </form>
    </div>
@endsection
