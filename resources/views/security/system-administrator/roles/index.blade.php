@extends('app')

@section('content')
    <div class="container">
        <table class="table">

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @error('color')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            @if (session('success'))
                <h6 class="alert alert-success">{{ session('success') }}</h6>
            @endif

            <thead class="thead-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Status</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->created_at }}</td>
                        <td>{{ $role->updated_at }}</td>
                        <td>{{ $role->status == 1 ? 'SI' : 'NO' }}</td>
                        <td>
                            @if ($role->name != 'ADMINSTRADOR_DE_SISTEMA')
                                <form action="{{ route('roles.changeStatus', [$role->id]) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    @if ($role->status == 1)
                                        <button type="submit" class="btn btn-danger">Desactivar</button>
                                    @else
                                        <button type="submit" class="btn btn-success">Activar</button>
                                    @endif
                                </form>
                            @endif

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
