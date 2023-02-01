<?php

namespace App\Service\PlatformService\Interfaces;


use App\Service\AccountService\AccountService;

interface PlatformInterface
{
    public function publicPlace(): PublicPlaceInterface;

    public function post(): PostInterface;

    public function account(AccountService$accountService): AccountInterface;
}