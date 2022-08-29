<?php

namespace App\Service\PlatformService\platforms\telegram\Actions;

use App\Service\PlatformService\Interfaces\PostInterface;
use App\Service\TelegramSdk\TelegramApiClient;

class Post implements PostInterface
{
    public function __construct(private TelegramApiClient $client)
    {
    }

    public function send(\App\Entity\Post $post): bool
    {
        foreach ($post->getAccounts() as $account) {
            $params = [
                'chat_id' => '@postunger',
                'text'    => $post->getText(),
            ];
            $this->client->sendMessage($account->getAccessToken(), $params);
        }

        return true;
    }
}