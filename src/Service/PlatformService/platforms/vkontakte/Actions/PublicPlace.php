<?php

namespace App\Service\PlatformService\platforms\vkontakte\Actions;

use App\Entity\Account;
use App\Service\PlatformService\Interfaces\PublicPlaceInterface;
use App\Service\PlatformService\models\PublicPlacesGetItem;
use VK\Client\VKApiClient;

class PublicPlace implements PublicPlaceInterface
{
    public function __construct(private VKApiClient $client)
    {
    }

    /**
     * @param Account $account
     * @return array|PublicPlacesGetItem[]
     * @throws \VK\Exceptions\Api\VKApiAccessGroupsException
     * @throws \VK\Exceptions\VKApiException
     * @throws \VK\Exceptions\VKClientException
     */
    public function pull(Account $account): array
    {
        $response = $this->client->groups()->get($account->getAccessToken(), [
            'user_id' => $account->getSid(),
            'filter'  => 'admin, editor',
            'extended'  => 1,
        ]);

        return array_map(function ($val) {
            return (new PublicPlacesGetItem())
                ->setId($val['id'])
                ->setName($val['name'])
                ->setPhoto($val['photo_200'] ?? $val['photo_100'] ?? $val['photo_50'] ?? null)
            ;
        }, $response['items']);
    }
}