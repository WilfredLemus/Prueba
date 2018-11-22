@extends('layout')

@section('title', "Usuario {$user->name}")

@section('content')

<h1>Eliminar el Usuario # {{ $user->id }}</h1>

<form action="{{ route('users.destroy', $user->id) }}" method="POST">
    {{ method_field('DELETE') }}
    {{ csrf_field() }}
    Esta seguro de eliminar el usuario {{ $user->id }}, nombre {{ $user->name }}
    <button class="btn btn-danger" type="submit">Eliminar</button>
</form>
    <p>
        <a href="{{ route('users.index') }}"> Regresar</a>
    </p>
@endsection
