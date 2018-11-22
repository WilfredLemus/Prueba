@extends('layout')

@section('title', "Usuario {$user->name}")

@section('content')

<h1>Usuario # {{ $user->id }}</h1>

Obteniendo el id del usuario {{ $user->id }}, nombre {{ $user->name }}

    <p>
        <a href="{{ route('users.index') }}"> Regresar</a>
    </p>
@endsection
