<?php

namespace Pushover\Api;

use Illuminate\Support\Facades\Http;

class ApiService
{
    /**
     * @param string $endpoint
     * @param array $payload
     *
     * @return mixed
     */
    public function post(string $endpoint, array $payload = [])
    {
        $url = 'https://api.pushover.net' . $endpoint;
        $payload['token'] = config('pushover.token');
        $payload['user'] = config('pushover.user');

        $response = Http::post($url,$payload);

        return json_decode($response);
    }

    public function get(string $endpoint)
    {
        $payload['token'] = config('pushover.token');

        $url = 'https://api.pushover.net' . $endpoint . '?' . http_build_query($payload);

        $response = Http::get($url);

        return json_decode($response);
    }
}
