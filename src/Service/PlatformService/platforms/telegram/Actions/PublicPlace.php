<?php

namespace App\Service\PlatformService\platforms\telegram\Actions;

use App\Service\PlatformService\Exceptions\PlatformServiceException;
use App\Service\PlatformService\Interfaces\PublicPlaceInterface;
use App\Service\TelegramSdk\TelegramApiClient;

class PublicPlace implements PublicPlaceInterface
{
    public function __construct(private TelegramApiClient $client)
    {
    }

    public function get($account_id): array
    {
        throw new PlatformServiceException('метод отсутствует!');
    }
}