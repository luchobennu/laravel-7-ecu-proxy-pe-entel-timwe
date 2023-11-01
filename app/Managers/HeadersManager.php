<?php

namespace App\Managers;

class HeadersManager
{

    public function getHeaders($type)
    {
        if ($type === 'OPERATOR') {
            $headers = [
                'Authorization' => 'Bearer ' . env('api_token'),
                'requestAudit' =>  '-',
                'X-Transaction-ID' => '-',
                'Content-type' => 'application/json'
            ];
        }

        if ($type === 'CORE') {
            $headers = [
                'Authorization' => 'Bearer ' . env('api_token'),
                'requestAudit' =>  '-',
                'X-Transaction-ID' => '-',
                'Content-type' => 'application/json'
            ];
        }
        return $headers;
        
    }
}
