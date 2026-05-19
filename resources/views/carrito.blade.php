@extends('layouts.app')

@section('content')

<h1>Carrito de compras</h1>

@if(session('carrito'))

<table class="table">

    <thead>

        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
            <th>Acciones</th>
        </tr>

    </thead>

    <tbody>

        @php $total = 0; @endphp

        @foreach($carrito as $item)

        @php
            $subtotal = $item['precio'] * $item['cantidad'];
            $total += $subtotal;
        @endphp

        <tr>

            <td>
                <img src="{{ $item['imagen'] }}"
                     width="80">
            </td>

            <td>{{ $item['nombre'] }}</td>

            <td>${{ $item['precio'] }}</td>

            <td>

                <form action="/carrito/actualizar"
                      method="POST">

                    @csrf

                    <input type="hidden"
                           name="id"
                           value="{{ $item['id'] }}">

                    <input type="number"
                           name="cantidad"
                           value="{{ $item['cantidad'] }}"
                           min="1">

                    <button class="btn btn-primary btn-sm">

                        Actualizar

                    </button>

                </form>

            </td>

            <td>${{ $subtotal }}</td>

            <td>

                <a href="/carrito/eliminar/{{ $item['id'] }}"
                   class="btn btn-danger btn-sm">

                    Eliminar

                </a>

            </td>

        </tr>

        @endforeach

    </tbody>

</table>

<h3>Total: ${{ $total }}</h3>

@if(session('token'))

<form action="/pedido/crear" method="POST">

    @csrf

    <button class="btn btn-success">

        Crear pedido

    </button>

</form>

@else

<div class="alert alert-warning mt-3">

    Debes iniciar sesión para crear pedidos.

</div>

@endif

<a href="/carrito/vaciar"
   class="btn btn-warning">

    Vaciar carrito

</a>

@else

<p>No hay productos en el carrito.</p>

@endif

@endsection