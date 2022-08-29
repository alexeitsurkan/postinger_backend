<?php

namespace App\Service\PlatformService\platforms\vkontakte\Actions;

use App\Service\PlatformService\Interfaces\PostInterface;
use VK\Client\VKApiClient;
use VK\Exceptions\VKApiException;
use VK\Exceptions\VKClientException;
use PHPUnit\Framework\Exception;

class Post implements PostInterface
{
    public function __construct(private VKApiClient $client)
    {
    }

    public function send(\App\Entity\Post $post): bool
    {
        foreach ($post->getAccounts() as $account) {
            try {
                $this->client->wall()->post($account->getAccessToken(), [
                    'owner_id' => $account->getSid(),
                    'message'  => $post?->getText() ?? ''
                ]);
            } catch (VKClientException|VKApiException $e) {
                throw new Exception($e->getMessage(), 500);
            }
        }

        return true;
    }
}