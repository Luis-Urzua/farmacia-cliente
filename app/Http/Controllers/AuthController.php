<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    private $api;

    public function __construct()
    {   
        $this->api = env('API_URL');
    }

    public function showRegistro()
    {
        return view('auth.registro');
    }

    public function registro(Request $request)
    {
        $response = Http::post($this->api . '/registro', [
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'password' => $request->password
        ]);

        // verificar si hubo error
        if (!$response->successful()) {

            dd($response->body());

        }

        return redirect('/login');
    }   

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $response = Http::post(
            env('API_URL') . '/login',
            [
                'correo' => $request->correo,
                'password' => $request->password
            ]
        );

        dd($response->json());
    }

    public function perfil()
    {
        $token = session('token');

        if (!$token) {
            return redirect('/login');
        }

        $response = Http::withToken($token)
            ->get($this->api . '/perfil');

        $usuario = $response->json()['data'];

        return view('auth.perfil', compact('usuario'));
    }

    public function updateProfile(Request $request)
    {
        $token = session('token');

        $response = Http::withToken($token)
            ->put($this->api . '/perfil', [
                'nombre' => $request->nombre,
                'correo' => $request->correo
            ]);

        if ($response->successful()) {

            return redirect('/perfil')
                ->with('success', 'Perfil actualizado');
        }

        return back()->with('error', 'Error al actualizar');
    }

    public function changePassword(Request $request)
    {
        $token = session('token');

        $response = Http::withToken($token)
            ->put($this->api . '/cambiar-password', [
                'password_actual' => $request->password_actual,
                'password_nueva' => $request->password_nueva
            ]);

        if ($response->successful()) {

            return redirect('/perfil')
                ->with('success', 'Contraseña actualizada');
        }

        return back()->with('error', 'Error al cambiar contraseña');
    }

    public function logout()
    {
        $token = session('token');

        Http::withToken($token)
            ->post($this->api . '/logout');

        session()->forget('token');
        session()->forget('cliente');

        return redirect('/');
    }

    public function updateImage(Request $request)
    {
        $request->validate([
            'imagen' => 'required|image'
        ]);

        $token = session('token');

        $response = Http::withToken($token)
            ->attach(
                'imagen',
                fopen($request->file('imagen')->getRealPath(), 'r'),
                $request->file('imagen')->getClientOriginalName()
            )
            ->post($this->api . '/perfil/imagen');

        if ($response->successful()) {

            return redirect('/perfil')
                ->with('success', 'Imagen actualizada');
        }

        return back()->with('error', 'Error al subir imagen');
    }   
}