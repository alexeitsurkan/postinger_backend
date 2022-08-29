<?php

namespace App\Service\TelegramSdk;

use GuzzleHttp\Client;

class TelegramApiClient
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://api.telegram.org/bot']);
    }

    public function sendMessage(string $token, array $params)
    {
        $this->client->request('GET', $token . '/sendMessage', [
            'query' => $params
        ]);
    }
}