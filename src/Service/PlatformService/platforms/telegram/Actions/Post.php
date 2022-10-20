<?php

namespace App\Service\PlatformService\platforms\telegram\Actions;

use App\Service\PlatformService\Exceptions\PlatformServiceException;
use App\Service\PlatformService\Interfaces\PostInterface;
use App\Service\TelegramSdk\TelegramApiClient;
use App\Entity\Post as EntityPost;
use App\Entity\PublicPlace as EntityPublicPlace;

class Post implements PostInterface
{
    public function __construct(private TelegramApiClient $client)
    {
    }

    public function send(EntityPost $post, EntityPublicPlace $place): bool
    {
        if ($account = $place->getAccount()) {
            throw new PlatformServiceException('Account not found!', 500);
        }

        $params = [
            'chat_id' => $place->getSid(),
            'text'    => $post->getText(),
        ];
        $this->client->sendMessage($account->getAccessToken(), $params);

        return true;
    }
}