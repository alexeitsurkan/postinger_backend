<?php

namespace App\Service\PlatformService\platforms\vkontakte\Actions;

use App\Service\PlatformService\Exceptions\PlatformServiceException;
use App\Service\PlatformService\Interfaces\PostInterface;
use App\Entity\Post as EntityPost;
use App\Entity\PublicPlace as EntityPublicPlace;
use VK\Client\VKApiClient;
use VK\Exceptions\VKApiException;
use VK\Exceptions\VKClientException;

class Post implements PostInterface
{
    public function __construct(private VKApiClient $client)
    {
    }

    public function send(EntityPost $post, EntityPublicPlace $place): bool
    {
        if (!$account = $place->getAccount()) {
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

        return true;
    }
}