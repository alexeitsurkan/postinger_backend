<?php

namespace App\Service\TelegramSdk;

use GuzzleHttp\Client;

class TelegramApiClient
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://api.telegram.org']);
    }

    public function sendMessage(string $token, array $params)
    {
        $this->client->request('GET', '/bot' . $token . '/sendMessage', [
            'query' => $params
        ]);
    }

    public function getMe(string $token):array
    {
        $responce = $this->client->request('GET', '/bot' . $token . '/getMe');
        $content = json_decode($responce->getBody()->getContents(),true);
        return $content['result'];
    }
}