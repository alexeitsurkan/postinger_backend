<?php

namespace App\Service\PlatformService\platforms\telegram\Actions;

use App\Service\AccountService\AccountService;
use App\Service\PlatformService\Interfaces\AccountInterface;
use App\Service\TelegramSdk\TelegramApiClient;

class Account implements AccountInterface
{
    public function __construct(private TelegramApiClient $client, private AccountService $accountService)
    {
    }

    public function add($params): int
    {
        $info = $this->client->getMe($params['token']);

        $params['account_id'] = $info['first_name'];
        return $this->accountService->add($params);
    }
}