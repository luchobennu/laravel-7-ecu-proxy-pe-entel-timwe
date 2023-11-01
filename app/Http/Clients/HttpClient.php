<?php

namespace App\Http\Clients;

use GuzzleHttp\Client;

class HttpClient
{
    private $client;
    private $headers;
    private $baseUri;

    public function __construct($headers, $baseUri)
    {
        $this->client = new Client();
        $this->headers = $headers;
        $this->baseUri = $baseUri;
    }

    public function get($uri, array $headers = [])
    {
        return $this->client->request('GET', $this->baseUri . $uri, ['headers' => $headers]);
    }

    public function post($uri, array $data = [])
    {
        $response = $this->client->request('POST',$this->baseUri .  $uri, ['json' => $data, 'headers' => $this->headers]);
        $result = ["code" => $response->getStatusCode(), "info" => json_decode($response->getBody()->getContents(), true)];
        return $result;
    }

    public function put($uri, array $data = [], array $headers = [])
    {
        return $this->client->request('PUT', $this->baseUri .  $uri, ['json' => $data, 'headers' => $headers]);
    }

    public function patch($uri, array $data = [], array $headers = [])
    {
        return $this->client->request('PATCH', $this->baseUri .  $uri, ['json' => $data, 'headers' => $headers]);
    }

    public function delete($uri, array $headers = [])
    {
        return $this->client->request('DELETE', $this->baseUri .  $uri, ['headers' => $headers]);
    }
}

