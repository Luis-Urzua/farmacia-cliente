@extends('layouts.app')

@section('content')

<h1>Detalle del pedido</h1>

<div class="card p-4 mb-4">

    <h4>Pedido #{{ $pedido['id_pedido'] }}</h4>

    <p>Estado: {{ $pedido['estado'] }}</p>

    <p>Total: ${{ $pedido['total'] }}</p>

</div>

<table class="table">

    <thead>

        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Subtotal</th>
        </tr>

    </thead>

    <tbody>

        @foreach($pedido['detalles'] as $detalle)

        <tr>

            <td>
                {{ $detalle['medicamento']['nombre'] }}
            </td>

            <td>
                {{ $detalle['cantidad'] }}
            </td>

            <td>
                ${{ $detalle['precio_unitario'] }}
            </td>

            <td>
                ${{ $detalle['cantidad'] * $detalle['precio_unitario'] }}
            </td>

        </tr>

        @endforeach

    </tbody>

</table>

@endsection