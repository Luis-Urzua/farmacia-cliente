<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarritoController extends Controller
{
    private $api;

    public function __construct()
    {   
        $this->api = env('API_URL');
    }
    
    public function index()
    {
        $carrito = session()->get('carrito', []);

        return view('carrito', compact('carrito'));
    }

    public function agregar(Request $request)
    {
        $carrito = session()->get('carrito', []);

        $id = $request->id;

        if (isset($carrito[$id])) {

            $carrito[$id]['cantidad']++;

        } else {

            $carrito[$id] = [
                "id" => $request->id,
                "nombre" => $request->nombre,
                "precio" => $request->precio,
                "imagen" => $request->imagen,
                "cantidad" => 1
            ];
        }

        session()->put('carrito', $carrito);

        return redirect('/carrito');
    }

    public function actualizar(Request $request)
    {
        $carrito = session()->get('carrito');

        if(isset($carrito[$request->id])) {

            $carrito[$request->id]['cantidad'] = $request->cantidad;

            session()->put('carrito', $carrito);
        }

        return redirect('/carrito');
    }

    public function eliminar($id)
    {
        $carrito = session()->get('carrito');

        if(isset($carrito[$id])) {

            unset($carrito[$id]);

            session()->put('carrito', $carrito);
        }

        return redirect('/carrito');
    }

    public function vaciar()
    {
        session()->forget('carrito');

        return redirect('/carrito');
    }
}