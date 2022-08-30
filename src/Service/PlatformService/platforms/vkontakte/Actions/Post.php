<?php

namespace App\Service\PlatformService\platforms\vkontakte\Actions;

use App\Service\PlatformService\Exceptions\PlatformServiceException;
use App\Service\PlatformService\Interfaces\PostInterface;
use VK\Client\VKApiClient;
use VK\Exceptions\VKApiException;
use VK\Exceptions\VKClientException;

class Post implements PostInterface
{
    public function __construct(private VKApiClient $client)
    {
    }

    public function send(\App\Entity\Post $post): bool
    {
        foreach ($post->getPublicPlaces() as $place) {
            if ($account = $place->getAccount()) {
                throw new PlatformServiceException('Account not found!', 500);
            }
            try {
                $this->client->wall()->post($account->getAccessToken(), [
                    'owner_id' => $account->getSid(),
                    'message'  => $post->getText()
                ]);
            } catch (VKClientException|VKApiException $e) {
                throw new PlatformServiceException($e->getMessage(), 500);
            }
        }

        return true;
    }
}