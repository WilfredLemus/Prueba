@extends('layout')

@section('title', "Nuevo Usuario")

@section('content')

<h1>Crear Nuevo Usuario</h1>

<form action="{{ route('users.index') }}" method="POST">
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
        <input class="form-control {{ ($errors->has('name'))? 'is-invalid':'' }}" type="text" name="name" value="{{ old('name') }}" required>
        @if($errors->has('name'))
            <div class="text-danger">
            <small>{{ $errors->first('name') }}</small>
            </div>
        @endif
    </div>
    <div class="form-group">
        <label>Email</label>
        <input class="form-control {{ ($errors->has('email'))? 'is-invalid':'' }}" type="email" name="email" value="{{ old('email') }}" required>
        @if($errors->has('email'))
            <div class="text-danger">
            <small>{{ $errors->first('email') }}</small>
            </div>
        @endif
    </div>
    <div class="form-group">
        <label>Contraseña</label>
        <input class="form-control {{ ($errors->has('password'))? 'is-invalid':'' }}" type="password" name="password" required>
        @if($errors->has('password'))
            <div class="text-danger">
            <small>{{ $errors->first('password') }}</small>
            </div>
        @endif
    </div>

    <button class="btn btn-primary" type="submit">Guardar</button>
</form>

<p>
    <a href="{{ route('users.index') }}"> Regresar</a>
</p>
@endsection
