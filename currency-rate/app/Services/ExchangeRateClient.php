<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ExchangeRateClient
{
    private string $base_url = 'https://api.exchangerate.host';

    private Client $client;

    public function __construct()
    {
        $this->setClient(new Client(['base_uri' => $this->base_url]));
    }
    public function sendRateRequest(array $params)
    {
        $uri = $params['uri'] ?? '';
        $query = !empty($params['from']) && !empty($params['to'])
            ? ['query' => ['from' => $params['from'], 'to' => $params['to']]]
            : [];
        return $this->client->request('GET', $uri, $query);
    }

    private function setClient(Client $client)
    {
        $this->client = $client;
    }
}
