@extends('layouts.app')

@section('content')

<h1>Mis pedidos</h1>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Estado Pedido</th>
            <th>Estado Pago</th>
            <th>Total</th>
            <th>Transacción</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>

    @foreach($pedidos as $pedido)

        <tr>

            <td>{{ $pedido['id_pedido'] }}</td>

            <td>{{ $pedido['fecha'] }}</td>

            <td>{{ $pedido['estado'] }}</td>

            <td>
                {{ $pedido['estado_pago'] ?? 'pendiente' }}
            </td>

            <td>
                ${{ $pedido['total'] }}
            </td>

            <td>
                {{ $pedido['transaction_id'] ?? 'Sin pago' }}
            </td>

            <td>

                <a href="/pedido/{{ $pedido['id_pedido'] }}"
                   class="btn btn-primary btn-sm">
                    Ver detalle
                </a>

                @if($pedido['estado'] != 'cancelado')

                    <a href="/pedido/cancelar/{{ $pedido['id_pedido'] }}"
                       class="btn btn-danger btn-sm">
                        Cancelar
                    </a>

                @endif

                @if(($pedido['estado_pago'] ?? '') != 'pagado'
                    && $pedido['estado'] != 'cancelado')

                    <a href="/pedido/pagar/{{ $pedido['id_pedido'] }}"
                       class="btn btn-success btn-sm">
                        Pagar
                    </a>

                @endif

            </td>

        </tr>

    @endforeach

    </tbody>

</table>

@endsection