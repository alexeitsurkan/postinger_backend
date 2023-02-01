<?php

namespace App\Service\PlatformService\platforms\vkontakte\Actions;

use App\Service\AccountService\AccountService;
use App\Service\PlatformService\Interfaces\AccountInterface;
use VK\Client\VKApiClient;

class Account implements AccountInterface
{
    public function __construct(private VKApiClient $client,private AccountService $accountService)
    {
    }

    public function add($params):int
    {
        return $this->accountService->add($params);
    }
}