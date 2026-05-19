@extends('layouts.app')

@section('content')

<h1>Catálogo</h1>

<div class="row">

@foreach($productos as $producto)

<div class="col-md-4">

    <div class="card mb-4">

        <img src="{{ $producto['imagen1'] }}" class="card-img-top">

        <div class="card-body">

            <h5>{{ $producto['nombre'] }}</h5>

            <p>{{ $producto['descripcion'] }}</p>

            <p>$ {{ $producto['precio'] }}</p>

            <a href="/detalle/{{ $producto['id_medicamento'] }}" class="btn btn-primary">
                Ver detalle
            </a>

        </div>

    </div>

</div>

@endforeach

</div>

@endsection