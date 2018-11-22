@extends('layout')

@section('title', 'Lista de Usuarios')

@section('content')
<div class="row mt-3">
    <h1>Listado de usuarios</h1>
    <a class="" href="{{ route('users.create') }}">Nuevo Usuario</a>
    <table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($users as $user)
            <tr>
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                    <a href="{{ route('users.show', $user->id)  }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                    <a href="{{ route('users.edit', $user)  }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                    <a href="{{ route('users.delete', $user)  }}" class="btn btn-danger"><i class="fa fa-times"></i></a>
                </td>
            </tr>
        @empty
            <tr><td colspan="3">No hay usuarios registrados</td></tr>
        @endforelse
    </tbody>
    </table>
</div>
@endsection
