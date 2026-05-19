@extends('layouts.app')

@section('content')

<h1>Login</h1>

<form method="POST" action="/login">

    @csrf

    <input type="email"
           name="correo"
           class="form-control mb-3"
           placeholder="Correo">

    <input type="password"
           name="password"
           class="form-control mb-3"
           placeholder="Contraseña">

    <button class="btn btn-primary">
        Iniciar sesión
    </button>

</form>

@endsection