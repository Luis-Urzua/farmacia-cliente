<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class ProductoController extends Controller
{
    private $api;

    public function __construct()
    {
        $this->api = env('API_URL');
    }

    public function catalogo()
    {
        $response = Http::get($this->api . '/medicamento');

        $productos = $response->json()['data'];

        return view('catalogo', compact('productos'));
    }

    public function detalle($id)
    {
        $response = Http::get($this->api . '/medicamento/' . $id);

        $producto = $response->json()['data'];

        return view('detalle', compact('producto'));
    }
}