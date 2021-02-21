<?php

namespace App\Http;
use GuzzleHttp;

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
     * The Guzzle Client.
     *
     * @var GuzzleHttp\Client
     */
    private $client;

    /**
     * Sandbox base url.
     *
     * @var string
     */
    private $url = "https://sandbox.easypag.com.br/api/v1";

    /**
     * Headers array.
     *
     * @var array
     */
    private $baseHeaders = [
        'User-Agent' => 'Chrome/69 Safari/537',
    ];

    /**
     * Create a new SandboxClient instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->client = new GuzzleHttp\Client([
            'base_uri' => $this->url,
            'timeout'  => 10,
            'verify' => false,
            'headers' => $this->base_headers
        ]);
    }

    public function request($request, $data, $method)
    {
        // return json_decode($this->client->request('POST', $url, [
        //     'body' => json_encode($data),
        //     'headers' => [
        //         'User-Agent' => 'Chrome/69 Safari/537',
        //         'Content-Type' => 'application/json;charset=UTF-8',
        //         'Accept' => '*/*'
        //     ]
        // ])->getBody());
    }
}
