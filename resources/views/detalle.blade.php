@extends('layouts.app')

@section('content')
    <h1>{{ $producto['nombre'] }}</h1>

    <div class="row">
        <div class="col-md-4">
            <img src="{{ $producto['imagen1'] }}" class="img-fluid mb-3">
        </div>

        <div class="col-md-4">
            <img src="{{ $producto['imagen2'] }}" class="img-fluid mb-3">
        </div>

        <div class="col-md-4">
            <img src="{{ $producto['imagen3'] }}" class="img-fluid mb-3">
        </div>
    </div>

    <div class="card p-4">
        <h3>Descripción</h3>
        <p>{{ $producto['descripcion'] }}</p>
        <h4>Precio: ${{ $producto['precio'] }}</h4>

        <form action="/carrito/agregar" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $producto['id_medicamento'] }}">
            <input type="hidden" name="nombre" value="{{ $producto['nombre'] }}">
            <input type="hidden" name="precio" value="{{ $producto['precio'] }}">
            <input type="hidden" name="imagen" value="{{ $producto['imagen1'] }}">

            <button class="btn btn-success mt-3">
                Agregar al carrito
            </button>
        </form>

        <h5>Existencia: {{ $producto['existencia'] }}</h5>
    </div>
@endsection