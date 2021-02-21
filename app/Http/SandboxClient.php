<?php

namespace App\Http;

use Illuminate\Support\Facades\Http;

class SandBoxClient
{
    /**
     * The API client id.
     *
     * @var string
     */
    private $clientId = "HQBlGwV0XMeKv9TKrcF6Zlzph6tHh9Nd";

    /**
     * The cliente secret.
     *
     * @var string
     */
    private $clientSecret = 'nhlCWdYjOSVNx6F33MOKm1U1KKvy8vawtjZZC0ID';


    /**
     * Sandbox base url.
     *
     * @var string
     */
    private $url = "https://sandbox.easypag.com.br/api/v1/";


    public function request($request, $data, $method)
    {
        if ($method == 'POST') {
            $response = Http::withBasicAuth($this->clientId, $this->clientSecret)
                ->post($this->url . $request, $data);
        } else {
            $response = Http::withBasicAuth($this->clientId, $this->clientSecret)
                ->get($this->url . $request);
        }

        return $response->json();
    }
}
