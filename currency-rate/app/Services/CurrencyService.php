<?php

namespace App\Services;

use Illuminate\Support\Arr;

class CurrencyService
{
    public function getCurrencyRate(string $from, string $to = 'UAH')
    {
        $client = new ExchangeRateClient();
        $params = ['uri' => '/convert', 'from' => $from, 'to' => $to];
        $response = $client->sendRateRequest($params);
        $data = json_decode($response->getBody()->getContents());
        if (!isset($data->info) || !isset($data->info->rate)) {
            throw new \Exception('No rate is provided');
        }
        return $data->info->rate;
    }
}
