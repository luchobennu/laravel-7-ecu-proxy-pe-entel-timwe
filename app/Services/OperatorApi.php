<?php

namespace App\Services;

use App\Http\Clients\HttpClient;
use GuzzleHttp\Exception\ClientException;

class Operator
{

    private $HttpClient;

    public function __construct(HttpClient $client)
    {
        $this->HttpClient = $client;
    }

    public function checkSubscription($data)
    {

        $query = [
            'serviceId' => $data['serviceId'],
            'userId' => $data['msisdn'],
        ];

        try {
            $response = $this->HttpClient->post('http://core.ecu.bennu.ltd/V1/checkSubscription', $query);
            $responseBody = json_decode($response->getBody()->getContents(), true);
            $statusCode = $response->getStatusCode();

            return response()->json($responseBody, $statusCode);
        } catch (ClientException $e) {
            return response()->json([
                'error' => $$e->getMessage()
            ], 500);
        }
    }
}
