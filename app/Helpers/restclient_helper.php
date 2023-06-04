<?php

function akses_restapi($method, $url, $data)
{
    $client = \Config\Services::curlrequest();
    $token = session()->get('token');
    $headers = [
        'Authorization' => 'Bearer ' . $token
    ];

    $response = $client->request(
        $method,
        $url,
        [
            'headers' => $headers,
            'form_params' => $data,
            'http_errors' => false
        ]
    );

    return $response;
}

function valid_token()
{
    $client = \Config\Services::curlrequest();
    $token = session()->get('token');
    $headers = [
        'Authorization' => 'Bearer ' . $token
    ];

    $response = $client->request(
        'GET',
        'http://localhost:8080/api/token',
        [
            'headers' => $headers,
            'http_errors' => false
        ]
    );

    if ($response->getStatusCode() == 401) {
        return false;
    }

    return true;
}
