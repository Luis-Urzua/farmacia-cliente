@extends('layouts.app')

@section('content')

<h1>Registro</h1>

<form method="POST" action="/registro">

    @csrf

    <input type="text"
           name="nombre"
           class="form-control mb-3"
           placeholder="Nombre">

    <input type="email"
           name="correo"
           class="form-control mb-3"
           placeholder="Correo">

    <input type="password"
           name="password"
           class="form-control mb-3"
           placeholder="Contraseña">

    <button class="btn btn-success">
        Registrarse
    </button>

</form>

@endsection