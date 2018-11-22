@extends('layout')

@section('title', "Editar Usuario")

@section('content')

<h1>Editar Usuario</h1>

<form action="{{ route('users.update', $user->id) }}" method="POST">
    {{ method_field('PUT') }}
    {{ csrf_field() }}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="form-group">
        <label>Nombre</label>
        <input class="form-control {{ ($errors->has('name'))? 'is-invalid':'' }}" type="text" name="name" value="{{ old('name', $user->name ) }}" required>
        @if($errors->has('name'))
            <div class="text-danger">
            <small>{{ $errors->first('name') }}</small>
            </div>
        @endif
    </div>
    <div class="form-group">
        <label>Email</label>
        <input class="form-control {{ ($errors->has('email'))? 'is-invalid':'' }}" type="email" name="email" value="{{ old('email', $user->email) }}" required>
        @if($errors->has('email'))
            <div class="text-danger">
            <small>{{ $errors->first('email') }}</small>
            </div>
        @endif
    </div>
    <div class="form-group">
        <label>Contraseña</label>
        <input class="form-control {{ ($errors->has('password'))? 'is-invalid':'' }}" type="password" name="password">
        @if($errors->has('password'))
            <div class="text-danger">
            <small>{{ $errors->first('password') }}</small>
            </div>
        @endif
    </div>

    <button class="btn btn-primary" type="submit">Actualizar</button>
</form>

<p>
    <a href="{{ route('users.index') }}"> Regresar</a>
</p>
@endsection
