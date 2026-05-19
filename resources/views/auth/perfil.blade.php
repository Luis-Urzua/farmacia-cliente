@extends('layouts.app')

@section('content')

@if(isset($usuario['imagen']))

<img src="{{ $usuario['imagen'] }}"
     width="150"
     class="rounded-circle mb-3">

@endif

<h1>Perfil</h1>

<div class="card p-4 mb-4">

    <h4>{{ $usuario['nombre'] }}</h4>

    <p>{{ $usuario['correo'] }}</p>

</div>

@if(session('success'))

<div class="alert alert-success">
    {{ session('success') }}
</div>

@endif

<h3>Actualizar perfil</h3>

<form action="/perfil/update" method="POST">

    @csrf

    <div class="mb-3">
        <label>Nombre</label>

        <input type="text"
               name="nombre"
               class="form-control"
               value="{{ $usuario['nombre'] }}">
    </div>

    <div class="mb-3">
        <label>Correo</label>

        <input type="email"
               name="correo"
               class="form-control"
               value="{{ $usuario['correo'] }}">
    </div>

    <button class="btn btn-primary">
        Actualizar
    </button>

</form>

<hr>

<hr>

<h3>Cambiar contraseña</h3>

<form action="/perfil/password" method="POST">

    @csrf

    <div class="mb-3">

        <label>Contraseña actual</label>

        <input type="password"
               name="password_actual"
               class="form-control">

    </div>

    <div class="mb-3">

        <label>Nueva contraseña</label>

        <input type="password"
               name="password_nueva"
               class="form-control">

    </div>

    <button class="btn btn-warning">
        Cambiar contraseña
    </button>

</form>

@if(session('error'))

<div class="alert alert-danger">
    {{ session('error') }}
</div>

@endif

<hr>

<h3>Actualizar imagen</h3>

<form action="/perfil/imagen"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    <input type="file"
           name="imagen"
           class="form-control mb-3">

    <button class="btn btn-info">
        Subir imagen
    </button>

</form>

@endsection