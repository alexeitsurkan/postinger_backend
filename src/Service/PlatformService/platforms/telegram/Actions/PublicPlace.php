<?php

namespace App\Service\PlatformService\platforms\telegram\Actions;

use App\Entity\Account;
use App\Service\PlatformService\Exceptions\PlatformServiceException;
use App\Service\PlatformService\Interfaces\PublicPlaceInterface;
use App\Service\TelegramSdk\TelegramApiClient;

class PublicPlace implements PublicPlaceInterface
{
    public function __construct(private TelegramApiClient $client)
    {
    }

    /**
     * @param Account $account
     * @return array
     * @throws PlatformServiceException
     */
    public function pull(Account $account): array
    {
        return [];
    }
}