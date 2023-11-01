<?php

namespace App\Services;

use App\Http\Clients\HttpClient;
use GuzzleHttp\Exception\ClientException;

class CoreApi
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
            $response = $this->HttpClient->post(env('COREGETSUBSCRIPTION'), $query);
            return $response;
        } catch (ClientException $e) {
            return response()->json([
                'error' => $$e->getMessage()
            ], 500);
        }
    }

    public function checkSubscriptionV2($data)
    {
        $query = [
            'serviceId' => $data['serviceId'],
            'userId' => $data['msisdn'],
        ];

        try {
            $response = $this->HttpClient->post(env('COREGETSUBSCRIPTION2'), $query);
            return $response;
        } catch (ClientException $e) {
            return response()->json([
                'error' => $$e->getMessage()
            ], 500);
        }
    }

    public function create($data)
    {
        $query = [
            'userId' => $data['msisdn'],
            'serviceId' => $data['serviceId'],
            'serviceOfferKey' => $data['serviceOfferKey'],
            'expirationTime' => 24,
            'subscriptionId' => $data['subscriptionId']
        ];

        try {
            $response = $this->HttpClient->post(env('CORE_GET_JWT'), $query);
            return $response;
            
        } catch (ClientException $e) {
            return response()->json([
                'error' => $$e->getMessage()
            ], 500);
        }
    }

    public function customCreate($data)
    {
        $data['userId'] = $data["msisdn"];
        unset($data["msisdn"]);

        try {
            $response = $this->HttpClient->post(env('CORE_GET_CUSTOM_JWT'), $data);
            return $response;
            
        } catch (ClientException $e) {
            return response()->json([
                'error' => $$e->getMessage()
            ], 500);
        }
    }

    public function validateToken($data)
    {
        try {
            $response = $this->HttpClient->post(env('CORE_REFRESH_JWT'), $data);
            return $response;
            
        } catch (ClientException $e) {
            return response()->json([
                'error' => $$e->getMessage()
            ], 500);
        }
    }

    public function validateCustomToken($data)
    {
        try {
            $response = $this->HttpClient->post(env('CORE_REFRESH_CUSTOM_JWT'), $data);
            return $response;
            
        } catch (ClientException $e) {
            return response()->json([
                'error' => $$e->getMessage()
            ], 500);
        }
    }
}
