<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PedidoController extends Controller
{
    private $api;

    public function __construct()
    {   
        $this->api = env('API_URL');
    }

    public function crear()
    {
        $token = session('token');

        $cliente = session('cliente');

        $carrito = session('carrito', []);

        if (!$token || empty($carrito)) {

            return redirect('/carrito');
        }

        $productos = [];

        foreach ($carrito as $item) {

            $productos[] = [
                'id_medicamento' => $item['id'],
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $item['precio']
            ];
        }

        $response = Http::withToken($token)
            ->post($this->api . '/pedido', [

                'id_usuario' => $cliente['id_usuario'],

                'productos' => $productos
            ]);

        if ($response->successful()) {

            session()->forget('carrito');

            return redirect('/pedidos')
                ->with('success', 'Pedido creado');
        }

        dd($response->body());
    }

    public function index()
    {
        $token = session('token');

        $cliente = session('cliente');

        $response = Http::withToken($token)
            ->get($this->api .
                '/pedido/usuario/' .
                $cliente['id_usuario']);

        $pedidos = $response->json()['data'];

        return view('pedidos.index',
            compact('pedidos'));
    }

    public function detalle($id)
    {
        $token = session('token');

        $cliente = session('cliente');

        $response = Http::withToken($token)
            ->get($this->api .
                '/pedido/usuario/' .
                $cliente['id_usuario'] .
                '/' . $id);

        $pedido = $response->json()['data'];

        return view('pedidos.detalle',
            compact('pedido'));
    }

    public function cancelar($id)
    {
        $token = session('token');

        Http::withToken($token)
            ->delete($this->api .
                '/pedido/' . $id);

        return redirect('/pedidos');
    }
}