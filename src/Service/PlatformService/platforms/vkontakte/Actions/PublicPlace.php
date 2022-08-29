<?php

namespace App\Service\PlatformService\platforms\vkontakte\Actions;

use App\Service\PlatformService\Interfaces\PublicPlaceInterface;
use App\Service\PlatformService\resources\PublicPlacesData;
use VK\Client\VKApiClient;

class PublicPlace implements PublicPlaceInterface
{
    public function __construct(private VKApiClient $client)
    {
    }

    public function get($account_id): array
    {
        if ($account = $this->accountRepository->find($account_id)) {
            //todo сделать постраничную выборку
            $response = $this->client->groups()->get($account->getAccessToken(), [
                'user_id' => $account->getSid(),
                'filter'  => 'admin, editor',
            ]);
        }

        return array_map(function ($val) {
            return (new PublicPlacesData())
                ->setId($val['id'])
                ->setName($val['name'])
                ->setPhoto($val['photo_200'] ?? $val['photo_100'] ?? $val['photo_50'] ?? null)
            ;
        }, $response['items']);
    }
}