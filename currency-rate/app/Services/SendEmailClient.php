<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class SendEmailClient
{
    private string $base_url = 'https://rapidprod-sendgrid-v1.p.rapidapi.com/mail/send';

    private Client $client;

    public function __construct()
    {
        $this->setClient(new Client(['base_uri' => $this->base_url]));
    }
    public function sendEmailRequest(array $params)
    {
        $recipient = $params['email'];
        $text = $params['text'];
        $response = $this->client->request('POST', $this->base_url, [
            'body' => '{
                "personalizations": [
                    {
                        "to": [
                            {
                                "email": "' . $recipient . '"
                            }
                        ],
                        "subject": "BTC Rate"
                    }
                ],
                "from": {
                    "email": "genesis@test.case"
                },
                "content": [
                    {
                        "type": "text/plain",
                        "value": "' . $text . '"
                    }
                ]
            }',
            'headers' => [
                'X-RapidAPI-Host' => env('RAPIDAPI_HOST'),
                'X-RapidAPI-Key' => env('RAPIDAPI_KEY'),
                'content-type' => 'application/json',
            ],
        ]);

        return $response->getBody();
    }

    private function setClient(Client $client)
    {
        $this->client = $client;
    }
}
