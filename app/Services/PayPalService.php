<?php


// app/Services/PayPalService.php

// namespace App\Services;

// use PayPalCheckoutSdk\Core\PayPalHttpClient;
// use PayPalCheckoutSdk\Core\SandboxEnvironment;
// use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
// use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;

// class PayPalService
// {
//     protected $client;

//     public function __construct()
//     {
//         $clientId = config('services.paypal.client_id');
//         $clientSecret = config('services.paypal.secret');
//         $environment = new SandboxEnvironment($clientId, $clientSecret);
//         $this->client = new PayPalHttpClient($environment);
//     }

//     public function createOrder($amount)
//     {
//         $request = new OrdersCreateRequest();
//         $request->prefer('return=representation');
//         $request->body = [
//             'intent' => 'CAPTURE',
//             'purchase_units' => [[
//                 'amount' => [
//                     'currency_code' => 'USD',
//                     'value' => $amount,
//                 ]
//             ]],
//             'application_context' => [
//                 'cancel_url' => route('paypal.cancel'),
//                 'return_url' => route('paypal.success'),
//             ]
//         ];

//         $response = $this->client->execute($request);
//         return $response;
//     }

//     public function captureOrder($orderId)
//     {
//         $request = new OrdersCaptureRequest($orderId);
//         return $this->client->execute($request);
//     }
// }


// app/Services/PayPalService.php

// use GuzzleHttp\Client;
// use PayPalCheckoutSdk\Core\PayPalHttpClient;
// use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
// use PayPalCheckoutSdk\Orders\OrdersCreateRequest;

// class PayPalService
// {
//     protected $clientId;
//     protected $secret;
//     protected $baseUrl;

//     protected $client;

//     public function __construct()
//     {
//         $this->clientId = config('services.paypal.client_id');
//         $this->secret = config('services.paypal.secret');
//         $this->baseUrl = config('services.paypal.sandbox') ? 'https://api-m.sandbox.paypal.com' : 'https://api-m.paypal.com';
//     }

//     public function getAccessToken()
//     {
//         $client = new Client();

//         $response = $client->post($this->baseUrl . '/v1/oauth2/token', [
//             'auth' => [$this->clientId, $this->secret],
//             'form_params' => ['grant_type' => 'client_credentials'],
//         ]);

//         $data = json_decode($response->getBody(), true);
//         return $data['access_token'];
//     }

//     public function sendPayout($email, $amount, $note = '')
//     {
//         $token = $this->getAccessToken();

//         $client = new Client();
//         $response = $client->post($this->baseUrl . '/v1/payments/payouts', [
//             'headers' => [
//                 'Authorization' => "Bearer $token",
//                 'Content-Type' => 'application/json',
//             ],
//             'json' => [
//                 'sender_batch_header' => [
//                     'sender_batch_id' => uniqid(),
//                     'email_subject' => "You've received a payout!",
//                 ],
//                 'items' => [
//                     [
//                         'recipient_type' => 'EMAIL',
//                         'amount' => [
//                             'value' => number_format($amount, 2, '.', ''),
//                             'currency' => 'USD',
//                         ],
//                         'receiver' => $email,
//                         'note' => $note ?: "Payout from our platform",
//                         'sender_item_id' => uniqid(),
//                     ],
//                 ],
//             ],
//         ]);

//         return json_decode($response->getBody(), true);
//     }


// }



namespace App\Services;

use GuzzleHttp\Client;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;

class PayPalService
{
    protected $client;
    protected $clientId;
    protected $secret;
    protected $baseUrl;

    public function __construct()
    {
        $this->clientId = config('services.paypal.client_id');
        $this->secret = config('services.paypal.secret');
        $this->baseUrl = config('services.paypal.sandbox')
            ? 'https://api-m.sandbox.paypal.com'
            : 'https://api-m.paypal.com';

        $environment = new SandboxEnvironment($this->clientId, $this->secret);
        $this->client = new PayPalHttpClient($environment);
    }

    public function createOrder($amount)
    {
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
            'intent' => 'CAPTURE',
            'purchase_units' => [[
                'amount' => [
                    'currency_code' => 'USD',
                    'value' => number_format($amount, 2, '.', ''),
                ]
            ]],
            'application_context' => [
                'cancel_url' => route('paypal.cancel'),
                'return_url' => route('paypal.success'),
            ]
        ];

        return $this->client->execute($request);
    }

    public function captureOrder($orderId)
    {
        $request = new OrdersCaptureRequest($orderId);
        return $this->client->execute($request);
    }

    public function getAccessToken()
    {
        $client = new Client();

        $response = $client->post($this->baseUrl . '/v1/oauth2/token', [
            'auth' => [$this->clientId, $this->secret],
            'form_params' => ['grant_type' => 'client_credentials'],
        ]);

        $data = json_decode($response->getBody(), true);
        return $data['access_token'];
    }

    public function sendPayout($email, $amount, $note = '')
    {
        $token = $this->getAccessToken();

        $client = new Client();
        $response = $client->post($this->baseUrl . '/v1/payments/payouts', [
            'headers' => [
                'Authorization' => "Bearer $token",
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'sender_batch_header' => [
                    'sender_batch_id' => uniqid(),
                    'email_subject' => "You've received a payout!",
                ],
                'items' => [
                    [
                        'recipient_type' => 'EMAIL',
                        'amount' => [
                            'value' => number_format($amount, 2, '.', ''),
                            'currency' => 'USD',
                        ],
                        'receiver' => $email,
                        'note' => $note ?: "Payout from our platform",
                        'sender_item_id' => uniqid(),
                    ],
                ],
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}
