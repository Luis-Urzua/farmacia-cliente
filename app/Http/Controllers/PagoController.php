<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Http;

class PagoController extends Controller
{
    private $api;

    public function __construct()
    {   
        $this->api = env('API_URL');
    }

    public function pagar($id)
    {
        $token = session('token');

        $response = Http::withToken($token)
            ->get($this->api . '/pedido/' . $id);

        $pedido = $response->json()['data'];

        $provider = new PayPalClient;

        $provider->setApiCredentials(config('paypal'));

        $provider->getAccessToken();

        $paypalOrder = $provider->createOrder([
            "intent" => "CAPTURE",

            "application_context" => [
                "return_url" => url('/paypal/success?id=' . $id),

                "cancel_url" => url('/paypal/cancel'),
            ],

            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "MXN",

                        "value" => $pedido['total']
                    ]
                ]
            ]
        ]);

        dd($paypalOrder);

        foreach ($paypalOrder['links'] as $link) {

            if ($link['rel'] == 'approve') {

                return redirect($link['href']);
            }
        }

        return back();
    }

    public function success(Request $request)
    {
        $provider = new PayPalClient;

        $provider->setApiCredentials(config('paypal'));

        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder(
            $request->token
        );

        $pedidoId = $request->id;

        $token = session('token');

        Http::withToken($token)
            ->post($this->api .
                '/pedido/pagar/' .
                $pedidoId, [

                'transaction_id' =>
                    $response['id']
            ]);

        return redirect('/pedidos')
            ->with('success', 'Pago realizado');
    }

    public function cancel()
    {
        return redirect('/pedidos')
            ->with('error', 'Pago cancelado');
    }
}